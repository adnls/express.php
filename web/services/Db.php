<?php

//chaque fonction de sa classe est traduiite en une string qui sert à query la db

class Db {

    private $connection = null;
    private $host = "localhost";
    private $user;
    private $password;
    private $dbname;

    public function __construct(){
        // Voir si on passe des paramètre au constructeur...
    }

    private function connectionExists(){
        //check if exists
        return $this->connection != null;
    }

    private function getAuthLevel(){
        //check if exists
        if (isset($_SESSION) && isset($_SESSION["passport"])){
            //echo "Auth ok<br/>";
            return $_SESSION["passport"]["level"];
        }
        throw new Exception('problem with session');
    }

    public function connect(){

        $this->dbname = getenv('BDD_NOM');

        if ($this->getAuthLevel() === 1){
            $this->user = getenv('ADMIN_MYSQL_LOGIN');
            $this->password = getenv('ADMIN_MYSQL_PASSWD');
        } else {
            $this->user = getenv('ENSEIGNANT_MYSQL_LOGIN');
            $this->password = getenv('ENSEIGNANT_MYSQL_PASSWD');
        }

        // Obtenir la liste des cours en fonction de l'année passé en parametre dans l'url
        if (!$this->connectionExists()){
            try {
                $this->connection = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->exec('SET CHARACTER SET utf8');

            } catch(PDOException $e){
                //créer des classes erreurs ppersonnalisées pour redirect ou 404 si il faut suivant les cas
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function query($action = null, $args = ""){
        //var_dump($this->connection);
        $this->connect();
        //SelectionnerEnseignements
        $res = $this->connection->query("CALL $action($args);");
        $data = $res->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function kill(){
        $this->connection = null;
    }
}
?>
