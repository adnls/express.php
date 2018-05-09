<?php

class PassportException extends Exception {}

class Passport {
    
    private $sessionStore;
    private $db;
    private $router;

    public function __construct($sessionStore, $db, $router){
        $this->sessionStore = $sessionStore;
        $this->db = $db;
        $this->router = $router;
    }

    public function initialize(){
        $this->sessionStore->connect();
        //si on veut un connection persistante
    }

    private function serialize($id){
        return $_SESSION["passport"] = $id; // = la corresponance en réalité avec login mot de passe
    }

    private function deserialize(){
        //requette en base
        //select * where uid = $_SESSION["passport"];

        $infos = [];
        $infos["name"] = "adnls";
        $infos["email"] = "david.ayache@gmail.com";
        $infos["level"] = 1;
        return $infos;
    }

    public function getUser(){
        return $this->deserialize();
    }

    public function verify(){
        
        if ($this->isAuthenticated()) {
            echo "Connection ok";
            return;
        }; 

        throw new PassportException("auth failed");
    }

    public function authenticate(){
        var_dump($_POST);
        //voir en base de données si il y a correspondance
        //requete attendue => une requette qui renvoie -1 ou la pk de la table 
        if ($_POST["name"] === "adnls" && $_POST["password"] === "123azerty") {
            $_SESSION["is_authenticated"] = TRUE; //explicit
            //mettre la clé de la table users dans les sessions => serialize
            //c'est tout le delire de passport
            $this->serialize(1); //on met la pk de l'user en db dans les var de session pour pouvoir les retrouver facilement

            return $this->router->redirect($this->router->getRedirectLocation());
        }

        throw new PassportException("tried to login but failed");
    }
    
    private function isAuthenticated(){

        $session_exists = isset($_SESSION);
        $var_exists = isset($_SESSION["is_authenticated"]);

        if ($var_exists && $session_exists)
            return $_SESSION["is_authenticated"];

        return FALSE;
    }
    
    public function logout(){
        $_SESSION["is_authenticated"] = FALSE;
        return $this->router->redirect('/login');
    }
}

?>