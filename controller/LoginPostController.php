<?php 
include_once('Controller.php');
class LoginPostController extends Controller  {
   
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    } 
    
    public function render(){
        $this->passport->authenticate();
    }
}

?>