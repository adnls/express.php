<?php 

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');
include_once('view/components/BreadCrumbs.php');
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
                
        //renvoie false si pas d'user donc en peut l'envoyer direct en param
        //la logique est aussi dans les components

        //les props
        $user = $this->passport->getUser();
        //if not user => definir  

        //les components
        $header = (new Header($user))->build();
        $menu = (new Menu())->build();
        $breadCrumbs = (new BreadCrumbs())->build();
        //new card avec title info1 info2
        $main = '<div class="Main">'
                .$breadCrumbs
                //card
                .'</div>';

        //le templating
        !$user ? $this->title = 'Home | Visitor' :  $this->title = 'Home | '.$user['name'];
        $this->style = '<link href="/work/static/css/style.css" rel="stylesheet"/>';
        $this->script = '<script type="text/javascript" src="/work/static/javascript/toggleMenu.js"></script>';
        $this->content = $header
                        .$menu
                        .$main;

        //le render final => voir dans le template
        return include('view/template.php');
    }
}
?>