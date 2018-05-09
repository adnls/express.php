<?php 

class LogoutController {
   
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    } 
    
    public function render(){
        $this->passport->logout();
    }
}

?>