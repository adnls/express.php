<?php 

//TODO split Passport => Passport / Strtegy
//TODO choisir entre template et component style

require('Router.php');
require('services/Database.php');
require('services/Passport.php');
require('services/Session.php');
require('services/SessionStore.php');
require('controller/HomeController.php');
require('controller/ParamController.php');
require('controller/NotFoundController.php');
require('controller/LoginGetController.php');
require('controller/LoginPostController.php');
require('controller/LogoutController.php');

$db = new Database("localhost",  "root", "123azerty", "php");
$db2 = new Database("localhost",  "root", "123azerty", "php");
$session = new Session();
$sessionStore = new SessionStore($session, $db2);
$router = new Router($_GET['url']);
$passport = new Passport($sessionStore, $db, $router);

//obligatoire => ne start que si elle ne sont pas démarée déjà
//pareil pour la db => c'est très important
$session->start();
//si on veut utilizer le session store
//$passport->initialize();

$router->get('/', function() use($router) {
    $router->redirect('/home');    
});

/*protected!!*/
$router->get('/home', function() use($db, $passport) {
    $controller = new HomeController($db, $passport);    
    $controller->render();
});

$router->get('/login', function() use($router){
    $controller = new LoginGetController($router);    
    $controller->render();
});

$router->post('/login', function() use($passport) {
    $controller = new LoginPostController($passport);    
    $controller->render();
});

$router->post('/logout', function() use($passport) {
    $controller = new LogoutController($passport);    
    $controller->render();
});

$router->get('/param/:id', function($id) use ($passport) {
    $controller = new ParamController($passport);    
    $controller->render($id);
});
    
try {
    
    //on essaye d'executer le callback associé à la route
    $router->run();  

//pas de redirect! on veut un code 401 pas un code redirect!
//on redir vers login que quand on logout sans erreur

} catch (PassportException $e) { //si il y aun pb au niveau du router

    $router->force401(function() use($router) {
        $controller = new LoginGetController($router);    
        $controller->render();
    });

} catch (RouterException $e) { //si il y a un pb avec l'auth

    $router->force404(function(){
        $controller = new NotFoundController();    
        $controller->render();
    });
}

?>