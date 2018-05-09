<?php 

class NotFoundController {

    public function render(){
        $title = '404';
        $content = '<h1>404 Not found</h1>';        
        return include('view/template.php');
    }
}

?>