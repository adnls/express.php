<?php

include_once('Controller.php');

//class Home extends Controller
class HomeController extends Controller {

    public function render(){
        $user = $this->getUserInfos();
        $title = "Home | " . $user['name'];
        if (!$user) $this->redirect('/auth/login');

        $tab = $this->db->query("SelectionnerEnseignements");

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        include('view/HomeView.php');
    }
}
