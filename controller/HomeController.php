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
        //$this->passport->authorize(); //on check si auth ok sur la session    
        if ($this->passport->isAuthenticated()){
            
            $user = $this->passport->getUser();
            $title = 'Home | '.$user['name'];
            
            $content = 
            '<form action="/work/auth/logout" method="post">
            <input type="submit" value="Logout">
            </form>
            <a href="/work/home">Home</a><br/>
            <a href="/work/param/random">Param</a>'.'<h1>'.$user["email"].'</h1>'.'<h2>Auth level : '.$user["level"].'</h2>';        
            return include('view/template.php');                
        }

        $title = 'Home | Visitor';
        
        $content = 
        '<a href="/work/auth/login"><button>Login</button></a><br/>
        <a href="/work/home">Home</a><br/>
        <a href="/work/param/random">Param</a><h1>Visitor Home</h1>';        
        return include('view/template.php');
        //si on arrive là c'est que c'est passé sinon on a déjà redirigé vers login get
        
        //et on prépare le template
    }
}

?>