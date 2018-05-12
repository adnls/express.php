<?php
//routes pour l'app
//type de routes : restricted => on laisse un visituer la voir mais avec un contenu restreint

require('controller/HomeController.php');

$router->get('/', function() use($router) {
    $router->redirect('/home');    
});

/*protected!!*/
$router->get('/home', function() use($db, $passport) {
    (new HomeController($db, $passport))->render();
});

?>
