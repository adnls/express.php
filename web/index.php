<?php
// Variable global debug affiché dans le footer
// ajouter les message séparé par  un " > " pour connaitre le chemin traversé
$GLOBALS["DEBUG"] = "";

if (!isset($_SESSION)) session_start();
/*les exceptions*/
require('exceptions.php');

/*le super router*/
require('Router.php');

$router = new Router();
/*les services*/
/*
$db = new Database("localhost",  "root", "123azerty", "sakila");
$passport = new Passport($db, $router);
*/
/*les controlleurs pour les erreurs*/
/*les autres sont instanciés dans les fichiers routes*/

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
    (new Controller)->force404();

} catch (PassportException $e) {
    (new Controller)->redirect('/auth/login');
    //si il a un pb ac l'auth
    //$router->redirect('/auth/login');

} catch (RouterException $e) {
    (new Controller)->force400();

} catch (PDOException $e) {
    (new Controller)->force400();

}

//TODO create lib folder avec les classes Route, Router, Service
//TODO split Passport => Passport / Strtegy / history
//utiliser la synthaxe namespaces => refactoring
//reflechir au choix techniques => CDN ?
//regarder secu => quel fichiers accessibles, comment?
//sanitize user inputs => sql injection, xcsrf, javascript injection, http, cookie httphonly, encryption
//login mots de passes encripter concat login mot de passe date inscription salt
//best practices

?>
