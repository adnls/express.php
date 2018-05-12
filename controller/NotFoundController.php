<?php 
include_once('Controller.php');

class NotFoundController extends Controller {

    public function render(){

        $this->title = '404';
        $this->content = '<h1>404 Not found</h1>';    
        $this->style = '<link href="/work/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;    
        
        return include('view/template.php');
    }
}

?>