<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL);
$router->namespace("Source\Login");

$router->group("ops");
$router->get("/{$errcode}", function ($data){
    echo "<h1>Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}