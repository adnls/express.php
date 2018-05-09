<?php 

require('Route.php');

class RouterException extends Exception {}
    
class Router {
    
        private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
        private $routes = []; // Contiendra la liste des routes

        public function __construct($url){
            $this->url = $url;
        }

        public function get($path, $callable){
            $route = new Route($path, $callable);
            $this->routes["GET"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }

        public function post($path, $callable){
            $route = new Route($path, $callable);
            $this->routes["POST"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }
    
        public function run(){
            if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
                throw new RouterException('REQUEST_METHOD does not exist');
            }
            foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){ //pour chaque item de la méthode demandée
                if($route->match($this->url)){ //si ça match
                    $this->updateHistory("/$this->url");
                    //var_dump($this->url);
                    return $route->call(); //on call un render
                }
            }

            throw new RouterException('Not Found');
        }

        public function redirect($to){
            header("Location: http://localhost/work$to");
            die();
        }

        public function force404($callable){
            header('HTTP/1.0 404 Not Found');
            call_user_func($callable);
            die();
        }

        public function force401($callable){
            header("HTTP/1.1 401 Unauthorized");
            call_user_func($callable);
            die();
        }
        private function updateHistory($path){
            $_SESSION["router_history"][]=$path;
        }

        public function getRedirectLocation(){

            //var_dump($_SESSION["router_history"][count($_SESSION["router_history"])-1]);

            for ($i = count($_SESSION["router_history"])-1; $i>=0; $i--){
                if ($_SESSION["router_history"][$i] !== '/login' && $_SESSION["router_history"][$i] !== '/logout')
                return $_SESSION["router_history"][$i];
            }          
        }
        public function getHistory(){
            return $_SESSION["router_history"];
        }
    }