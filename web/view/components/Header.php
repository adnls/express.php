<?php

include_once('Component.php');
include_once('view/components/AuthButtons.php');

class Header extends Component {
    
    private $user;

    public function __construct($user){
        $this->user = $user;
    }

    public function build(){

        $authButtons = (new AuthButtons($this->user))->build();

        return '<header>'
                    .'<button onclick="toggleMenu()">Toggle</button>'
                    .'<br/>'
                    .$authButtons
                .'</header>';  
        }    
    }
?>