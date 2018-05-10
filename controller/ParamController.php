<?php 

class ParamController {
    
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
        
        if ($id === null){
            if (isset($_GET['id'])){
                $id = $_GET['id'];
            } else { //on peut même envoyer une page générale si on veut
                //la j'ai mis une erreur
                throw new NotFoundException('404 Not found!');       
            }
        }

        
        echo "verifying<br/>";
        $this->passport->authorize(); //on check si auth ok sur la session    
        
        $title = 'Param | '.$id;

        $content =
        '<form action="/work/auth/logout" method="post">
        <input type="submit" value="Logout">
        </form>
        <a href="/work/home">Home</a><br/>
        <a href="/work/param/random">Param</a>'."<h1>$id</h1>";
        return include('view/template.php');
    }
}

?>