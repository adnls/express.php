<?php 

include_once('Controller.php');

class LogoutController extends Controller {
    
    public function render(){
        $this->auth->logout();
        $this->redirect('/auth/login');
    }
}

?>