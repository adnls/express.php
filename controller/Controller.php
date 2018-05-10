<?php

//pas de surcharge de classe 
//comme ça on peut forcer le render mais aussi y ajouter un param

interface ControllerInterface {
    public function render();
}

class Controller {
    public function render(){
        echo 'Hello world!';
    }
}

?>