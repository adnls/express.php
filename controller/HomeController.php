<?php 

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');

//class Home extends Controller implements Auth, Db, Session, Router 
class HomeController extends Controller {

    private $db;
    private $passport;

    public function __construct($db, $passport){
        $this->passport = $passport;
        $this->db = $db;
    } 

    public function render(){
        //dans render on définit juste les variables utilisées dans la view correspondaante

        //on dispose de la db, du passport, si on veut du router aussi
        //grâce à l'injection de dépendence
                
        //renvoie false si pas d'user
        $user = $this->passport->getUser();

        $header = (new Header($user))->build();
        $menu = (new Menu())->build();

        !$user ? $title = 'Home | Visitor' :  $title = 'Home | '.$user['name'];

        $content = $header.$menu;

        return include('view/template.php');
    }
}
?>