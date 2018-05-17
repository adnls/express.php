<?php
//routes pour l'app
//type de routes : restricted => on laisse un visituer la voir mais avec un contenu restreint

require('controller/HomeController.php');

$router->onGET('/', function(){
   (new controller())->redirect('/home');    
});

/*protected!!*/
$router->onGET('/home', function() {
    (new HomeController())->render();
});

?>
