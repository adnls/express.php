<?php 
include_once('Controller.php');
class LoginPostController extends Controller  {

    public function render(){

        if ($this->auth->login()){
            $to = $this->getReferrer();
            
        } else {
            $to = '/auth/login';
        }
        $this->redirect($to);
    }
}

?>