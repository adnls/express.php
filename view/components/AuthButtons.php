<?php
include_once('Component.php');

class AuthButtons extends Component {

    private $user;

    public function __construct($user){
        $this->user = $user; 
    }
   
    public function build(){
        
        if (!$this->user) {
            $content = '<a href="/work/auth/login">
                        <button>Login</button>
                        </a>
                        <br/>';
        } else {
            $content = $this->user['name']
                        .'<br/>'
                        .$this->user['email']
                        .'<br/>'
                        .'<form action="/work/auth/logout" method="post">
                        <input type="submit" value="Logout">
                        </form>';
        }    
        return $content;
    }
}  
?>