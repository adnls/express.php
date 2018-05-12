<?php
/*route pour l'app*/
/*type de route hidden => seul un visireur authentifié peut s'y rendre*/
//si pas authentifié, redir vers login sans rien montrer

require('controller/ParamController.php');

$router->get('/param', function() use ($passport) {
    (new ParamController($passport))->render();
});

$router->get('/param/:id', function($id) use ($passport) {
    (new ParamController($passport))->render($id);
});

?>