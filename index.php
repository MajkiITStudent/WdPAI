<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

//sciezki do metod z repozytorium

Routing::get('index', 'DefaultController');
Routing::get('events', 'EventController');
Routing::post('login', 'SecurityController');
Routing::post('addEvent', 'EventController');
Routing::post('register', 'SecurityController');
Routing::post('search', 'EventController');
Routing::get('like', 'EventController');
Routing::post('logout', 'SecurityController');
Routing::run($path);