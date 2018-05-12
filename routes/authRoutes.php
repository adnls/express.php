<?php
//routes pour l'auth


/*pas besoin de require les services en fait ça merge les scripts comme si c'était sur la même page
comme dans sas => on peut pas faire la même api qu'express ce serait contre nature*/

require('controller/LoginGetController.php');
require('controller/LoginPostController.php');
require('controller/LogoutController.php');

$router->get('/auth/login', function() use($router){
    (new LoginGetController($router))->render();
});

$router->post('/auth/login', function() use($passport) {
    (new LoginPostController($passport))->render();
});

$router->post('/auth/logout', function() use($passport) {
    (new LogoutController($passport))->render();
});


?>