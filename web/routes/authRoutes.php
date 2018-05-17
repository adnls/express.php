<?php
//routes pour l'auth

/*pas besoin de require les services en fait ça merge les scripts comme si c'était sur la même page
comme dans sas => on peut pas faire la même api qu'express ce serait contre nature*/

require('controller/LoginGetController.php');
require('controller/LoginPostController.php');
require('controller/LogoutController.php');

$router->onGET('/auth/login', function(){
    (new LoginGetController())->render();
});

$router->onPOST('/auth/login', function(){
    (new LoginPostController())->render();
});

$router->onPOST('/auth/logout', function(){
    (new LogoutController())->render();
});

?>