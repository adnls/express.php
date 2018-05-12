<?php 

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');
include_once('view/components/BreadCrumbs.php');
include_once('view/components/Table.php');

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

        $array = array(
            array(
            'color' => 'blue',
            'number' => 23,
            'size' => 'XL'
            ),
            array(
                'color' => 'red',
                'number' => 74,
                'size' => 'L'
            ),
            array(
                'color' => 'green',
                'number' => 98,
                'size' => 'M'
            ),
            array(
                'color' => 'yellow',
                'number' => 16,
                'size' => 'S'
            ));
        //if not user => definir  

        //les components
        $header = (new Header($user))->build();
        $menu = (new Menu())->build();
        $breadCrumbs = (new BreadCrumbs())->build();
        
        if (!$user){
            $main = '<div class="Main">'
                        .$breadCrumbs
                        .'<h2>Hello Visitor!</h2>
                    </div>';
        } else {
            $table = (new Table($array))->build();
            
            //new card avec title info1 info2
            $main = '<div class="Main">'
                        .$breadCrumbs
                        .$table
                    .'</div>';
        }

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