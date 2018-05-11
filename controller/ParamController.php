<?php 

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');

class ParamController extends Controller {
    
    private $passport;

    public function __construct($passport){
        $this->passport = $passport;
    }

    public function render($id = null){

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
        $this->passport->authorize(); //on check si auth ok sur la session    

        $header = (new Header($this->passport->getUser()))->build();
        $menu = (new Menu())->build();
        
        $title = 'Param | '.$id;
        $content = $header.$menu.'<div class="main"><h1>'.$id.'</h1></div>';

        return include('view/template.php');
    }
}

?>