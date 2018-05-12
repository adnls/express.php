<?php 

include_once('Controller.php');

class LoginGetController extends Controller {

    private $router;
    
    public function __construct($router){
        $this->router = $router;
    } 

    public function render(){

        $this->title = 'Login';
    
        $this->content = 
            '<h1>Login</h1>
            <form action="/work/auth/login" method="post">
            Login: <input type="text" name="name"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit">
            </form><br/>';
        
        $from= $this->router->getReferer();

        if ($from !== "" && $from !== null && $from !== '/home') 
            $this->content = "<h3>you cant access : $from</h3>".$this->content;
        
        $this->style = '<link href="/work/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        
        return include('view/template.php');
    }
}

?>