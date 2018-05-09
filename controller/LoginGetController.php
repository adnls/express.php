<?php 

class LoginGetController {

    private $router;
    
    public function __construct($router){
        $this->router = $router;
    } 

    public function render(){

        $title = 'Login';
    
        $content = 
            '<h1>Please Login</h1>
            <form action="/work/login" method="post">
            Login: <input type="text" name="name"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit">
            </form><br/>';
        
        $history = $this->router->getHistory();
        $from = $history[count($history)-1];
        if ($from !== '/home' && $from !== '/login') $content = "<h3>you cant access : $from</h3>".$content;
        return include('view/template.php');
    }
}

?>