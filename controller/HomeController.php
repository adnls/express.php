<?php 

//class Home extends Controller implements Auth, Db, Session, Router 
class HomeController {

    private $db;
    private $passport;

    public function __construct($db, $passport){
        $this->passport = $passport;
        $this->db = $db;
    } 

    public function render(){
        
        //on dispose de la db, du passport, si on veut du router aussi
        //grâce à l'injection de dépendence

        echo "verifying<br/>";
        $this->passport->verify(); //on check si auth ok sur la session    
        
        //si on arrive là c'est que c'est passé sinon on a déjà redirigé vers login get
        $user = $this->passport->getUser();

        //et on prépare le template
        $title = 'Home | '.$user['name'];
        
        $content = 
        '<form action="/work/logout" method="post">
        <input type="submit" value="Logout">
        </form>'.'<h1>'.$user["email"].'</h1>'.'<h2>Auth level : '.$user["level"].'</h2>';        
        return include('view/template.php');
    }
}

?>