<?php

include_once('services/Db.php');
include_once('services/Auth.php');
//pas de surcharge de classe 
//comme ça on peut forcer le render mais aussi y ajouter un param

class Controller {
    
    protected $title;
    protected $content;    
    protected $style;
    protected $script;    
    protected $db;
    protected $auth;

    public function __construct(){
        $this->db = new Db("localhost",  "root", "123azerty", "sakila");
        $this->auth = new Auth($this->db);
    }

    public function render(){
        echo 'Hello world!';
    }

    public function getUserInfos(){
        if (isset($_SESSION) && isset($_SESSION['passport'])){
            return $_SESSION['passport'];
        }
        return FALSE;
    }
    
    /*public function getParams(){
        if (isset($_SESSION) && isset($_SESSION['params'])){
            return $_SESSION['params'];
        }
        return FALSE;
    }*/

    public function redirect($to = '/home'){
        header("Location: http://localhost/web$to");
        die();
    }

    public function getReferrer(){
        
        //refactor avec regex !!!!!!!!! /auth/*
        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if ($_SESSION["history"][$i] !== '/auth/login' && $_SESSION["history"][$i] !== '/auth/logout')
            return $_SESSION["history"][$i];
        }
        return '/';
    }

    public function getWholeHistory(){
        return $_SESSION["history"];
    }

    public function getCurrentUrl(){
        return $_SESSION["history"][count($_SESSION["history"])-1];
    }

    public function force400(){
        header("HTTP/1.1 400 Bad request");
        die();
    }

    public function force401(){
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    public function force403(){
        /*$this->title = '403 | Forbidden';
        $this->content = '<h1>403 Forbidden</h1>';    
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        
        include('view/template.php');*/
        header('HTTP/1.1 403 Forbidden');
        die();
    }

    public function force404(){
        $this->title = '404 | Not Found';
        $this->content = '<h1>404 Not found</h1>';    
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        header('HTTP/1.1 404 Not Found');
        include('view/template.php');
        die();
    }
}

?>