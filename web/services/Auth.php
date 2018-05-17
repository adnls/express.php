<?php

class Auth {
    
    //private $sessionStore;
    private $db;

    public function __construct($db){
        //$this->sessionStore = $sessionStore;7
        
        $this->db = $db;
        
    }

    /*!!!!!!!*/
    //pb requete en base à chaque get user => c php vaut mieux les mettre dans session
    /*créer classe strategy*/

    //a voir
    public function login(){
    
        //voir en base de données si il y a correspondance
        //requete attendue => une requette qui renvoie -1 ou la pk de la table 
        if ($_POST["name"] === "adnls" && $_POST["password"] === "123azerty") {
            //explicits
            //mettre la clé de la table users dans les sessions => serialize
            //c'est tout le delire de passport
            $_SESSION["passport"]["id"] = 1;
            $_SESSION["passport"]["name"] = "adnls";
            $_SESSION["passport"]["email"] = "david.ayache90@gmail.com";
            $_SESSION["passport"]["level"] = 1;
            
             //on met la pk de l'user en db dans les var de session pour pouvoir les retrouver facilement
            //var_dump($this->router->getRefferer());
            return TRUE;
        }

        return FALSE;
    }
    
    private function isAuthenticated(){
        return isset($_SESSION) && isset($_SESSION["passport"]);
    }
    
    public function logout(){
        if (isset($_SESSION)) session_destroy();
    }
}

?>