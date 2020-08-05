<?php

require __DIR__."/vendor/autoload.php";
require __DIR__ . "/source/login/ControllerLogin.php";
require __DIR__ . "/source/affiliate/ControllerAffiliate.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);
$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/", function() {
    echo "<h1>Olá Mundo!</h1>";
});


$router->get("/login", "ControllerLogin:renderLogin");
$router->get("/lista-geral", "ControllerAffiliate:renderGeneralList");



$router->group("ops");
$router->get("/{errcode}", function ($data){
    echo "<h1>Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}