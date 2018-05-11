<?php

include_once('Component.php');
include_once('view/components/AuthButtons.php');

class Header implements Component {

    private $user;

    public function __construct($user){
        $this->user = $user;
    }

    public function build(){

        $authButtons = (new AuthButtons($this->user))->build();

        if (!$this->user){
            return '<header>'
                     
                        .'<button onclick="toggleMenu()">Toggle</button>'
                        .'<br/>'
                        .$authButtons
                    .'</header>';  
        }

        return '<header>'
                    .'<button onclick="toggleMenu()">Toggle</button>'
                    .'<br/>'
                    .$this->user['name']
                    .'<br/>'
                    .$this->user['email']
                    .'<br/>'
                    .$authButtons
                .'</header>';          
    }
}
?>