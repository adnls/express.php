<?php
//split with app // router // history
require('Route.php');
class Router {

        private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
        private $routes = []; // Contiendra la liste des routes

        public function __construct(){
            $this->url = $_GET['url'];
        }

        public function onGET($path, $callable){
            $route = new Route($path, $callable);
            $this->routes["GET"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }

        public function onPOST($path, $callable){
            $route = new Route($path, $callable);
            $this->routes["POST"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }

        public function listen(){
            if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
                throw new RouterException('REQUEST_METHOD does not exist');
            }

            foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){ //pour chaque item de la méthode demandée
                if($route->match($this->url)){ //si ça match
                    $_SESSION['history'][] = '/'.$this->url;
                    return $route->call(); //on call un render
                }
            }
            throw new NotFoundException('Not Found');
        }
    }
