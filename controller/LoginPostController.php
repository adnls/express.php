<?php 

class LoginPostController {
   
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    } 
    
    public function render(){
        $this->passport->authenticate();
    }
}

?>