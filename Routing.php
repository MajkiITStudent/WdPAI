<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/EventController.php';

class Routing {
    public static $routes;

    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller){
        self::$routes[$url] = $controller;
    }

    public static function run($url){
        //fragmenty url'a oddzielone slashem
        $parts = explode("/",$url);
        $action = $parts[0];

        if(!array_key_exists($action,self::$routes)){
            die("Url not correct");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        //druga czesc url to id projektu
        $id = $parts[1] ?? '';
        $object->$action($id); //wywołanie akcji z controllera
    }

}