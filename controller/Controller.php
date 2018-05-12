<?php

//pas de surcharge de classe 
//comme ça on peut forcer le render mais aussi y ajouter un param

class Controller {
    
    protected $title;
    protected $style;
    protected $script;
    protected $content;

    public function render(){
        echo 'Hello world!';
    }
}

?>