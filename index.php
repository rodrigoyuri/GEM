<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);
$router->namespace("Source\Affiliate");

$router->group(null);
$router->get("/", function($data) {
    echo "<h1>Hello World!</h1>";
});
$router->get("/lista-geral", "ControllerAffiliate:listAffiliate");


$router->group("ops");
$router->get("/{errcode}", function ($data){
    echo "<h1>Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}