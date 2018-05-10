<?php
/*route pour l'app*/
/*type de route hidden => seul un visireur authentifié peut s'y rendre*/
//si pas authentifié, redir vers login sans rien montrer

require('controller/ParamController.php');

$router->get('/param', function() use ($passport) {
    $controller = new ParamController($passport);    
    $controller->render();
});

$router->get('/param/:id', function($id) use ($passport) {
    $controller = new ParamController($passport);    
    $controller->render($id);
});

?>