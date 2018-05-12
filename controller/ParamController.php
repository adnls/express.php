<?php 

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');
include_once('view/components/BreadCrumbs.php');
include_once('view/components/Table.php');

class ParamController extends Controller {
    
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    }

    public function render($param = null){

        //si c'est une route sans argument c'est à dire sans :id
        //mais avec ?id=truc
        //on va lire le param dans l'url
        //si il n'y a pas de params on envoye une page param générale

        //c'est un peu chelou tt ça mais c'est pour montrer les différentes possibilités avec param
        
        /*if ($id === null){
            if (isset($_GET['id'])){
                $id = $_GET['id'];
            } else { //on peut même envoyer une page générale si on veut
                //la j'ai mis une erreur
                throw new NotFoundException('404 Not found!');       
            }
        }*/

        //si ça fail ça redirect et ça lance pas la suite
        
        //les credentials
        $this->passport->authorize(); //on check si auth ok sur la session    

        //les props
        //c'est ici par exemple qu'on va aller chercher un dataset en db
        $user = $this->passport->getUser();
            
        if ($param === null) $param = 'All Parameters';

        //les components
        //c'est ici qu'on va appeler le component qui render le tableau
        $header = (new Header($user))->build();
        $menu = (new Menu())->build();
        $breadCrumbs = (new BreadCrumbs())->build();
        
        //le templating
        $this->title = 'Param | '.$param;
        $this->style = '<link href="/work/static/css/style.css" rel="stylesheet"/>';
        $this->script = '<script type="text/javascript" src="/work/static/javascript/toggleMenu.js"></script>';
        $this->content = $header.$menu.'<div class="Main">'.$breadCrumbs.'<h2>'.$param.'</h2></div>';

        //le render
        return include('view/template.php');
    }
}

?>