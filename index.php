<?php 

/*les exceptions*/
require('exceptions.php');

/*le super router*/
require('Router.php');

$router = new Router($_GET['url']);

/*les services*/
require('services/Database.php');
require('services/Passport.php');

$db = new Database("localhost",  "root", "123azerty", "php");
$passport = new Passport($db, $router);

/*les controlleurs pour les erreurs*/
/*les autres sont instanciés dans les fichiers routes*/
require('controller/NotFoundController.php');

/*les routes*/
include('routes/homeRoutes.php');
include('routes/authRoutes.php');
include('routes/paramRoutes.php');

try {
    //on essaye d'executer le callback associé à la route
    $router->listen();  

//pas de redirect! on veut un code 401 pas un code redirect!
//on redir vers login que quand on logout sans erreur


} catch (NotFoundException $e) { //si il y aun pb au niveau du router
    $router->force404(function(){
        $controller = new NotFoundController();    
        $controller->render();
    });

} catch (PassportException $e) { 
    //si il a un pb ac l'auth
    $router->redirect('/auth/login');

} catch (RouterException $e) { 
    //si il y a un pb avec l'a route
    $router->force404(function(){
        $controller = new NotFoundController();    
        $controller->render();
    });

} catch (PDOException $e) { 
    //si il y a un pb avec la bdd
    $router->force404(function(){
        $controller = new NotFoundController();    
        $controller->render();
    });
}

//TODO split Passport => Passport / Strtegy
//TODO choisir entre template et component style

?>