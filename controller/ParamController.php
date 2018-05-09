<?php 

class ParamController {
    
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    }

    public function render($id){
        
        echo "verifying<br/>";
        $this->passport->verify(); //on check si auth ok sur la session    
        
        $title = 'Param';
        $content = '<form action="/work/logout" method="post">
        <input type="submit" value="Logout">
        </form>'."<h1>$id</h1>";        
        return include('view/template.php');
    }
}

?>