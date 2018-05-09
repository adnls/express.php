<?php 
class SessionStore {
    
    private $db;
    private $session;

    public function __construct($session, $db){
        $this->session = $session;
        $this->db =$db;
    }

    public function connect(){
        $this->db->connect();
    }
    public function getCurrentUser(){
        return;
    }

    public function register(){
        //$db insert one  si il n'est pas dedans
        //si dedans on update
        return;
    }
}

?>