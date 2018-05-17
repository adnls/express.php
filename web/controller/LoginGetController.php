<?php 

include_once('Controller.php');

class LoginGetController extends Controller {

    public function render(){

        $this->title = 'Login';
        
        //créer un component 
        $this->content = 
            '<h1>Login</h1>
            <form action="/web/auth/login" method="post">
            Login: <input type="text" name="name"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit">
            </form><br/>';
        
        /*pas nécéssaire car utilisateur forcément loggé*/
        $from= $this->getReferrer();

        if ($from !== "" && $from !== null && $from !== '/home') 
            $this->content = "<h3>you cant access : $from</h3>".$this->content;
        
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        
        return include('view/template.php');
    }
}

?>