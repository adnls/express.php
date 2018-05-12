<?php

class Passport {
    
    //private $sessionStore;
    private $db;
    private $router;

    public function __construct($db, $router){
        //$this->sessionStore = $sessionStore;7
        if (!isset($_SESSION)) session_start();
        $this->db = $db;
        $this->router = $router;
    }

    /*!!!!!!!*/
    //pb requete en base à chaque get user => c php vaut mieux les mettre dans session
    /*créer classe strategy*/
    private function serialize($payload){
        $_SESSION["passport"]["id"] = $payload["id"];
        $_SESSION["passport"]["name"] = $payload["name"];
        $_SESSION["passport"]["email"] = $payload["email"];
        $_SESSION["passport"]["level"] = $payload["level"];
    }

    private function deserialize(){
        //requette en base
        //select * where uid = $_SESSION["passport"];

       return $_SESSION["passport"];
    }

    public function getUser(){
        if ($this->isAuthenticated()) 
            return $this->deserialize();
        return FALSE;
    }

    public function authorize(){
        
        if ($this->isAuthenticated()) {            
            return;
        };         
        throw new PassportException("auth failed");
    }

    //a voir
    public function authenticate(){
        var_dump($_POST);
        //voir en base de données si il y a correspondance
        //requete attendue => une requette qui renvoie -1 ou la pk de la table 
        if ($_POST["name"] === "adnls" && $_POST["password"] === "123azerty") {
            //explicit
            //mettre la clé de la table users dans les sessions => serialize
            //c'est tout le delire de passport
            $payload["id"] = 1;
            $payload["name"] = "adnls";
            $payload["email"] = "david.ayache90@gmail.com";
            $payload["level"] = 1;
            
            $this->serialize($payload); //on met la pk de l'user en db dans les var de session pour pouvoir les retrouver facilement
            //var_dump($this->router->getRefferer());
            return $this->router->redirect($this->router->getReferer());
        }

        throw new PassportException("tried to login but failed");
    }
    
    private function isAuthenticated(){

        if (isset($_SESSION) && isset($_SESSION["passport"])){
            //echo "Auth ok<br/>";
            return TRUE;
        }

        //echo "Not authenticated<br/>";
        return FALSE;
    }
    
    public function logout(){
        if (isset($_SESSION)) session_destroy();
        return $this->router->redirect('/home');
    }
}

?>