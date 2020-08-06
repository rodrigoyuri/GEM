<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/source/login/ControllerLogin.php";
require __DIR__ . "/source/afiliado/ControllerAfiliado.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);
$router->namespace("Source\Controllers");

$router->group(null);

$router->get("/", "ControllerLogin:renderLogin");
$router->post("/", "ControllerLogin:logIn", "login.login");
$router->get("/esqueceu-senha", "ControllerLogin:renderForgotPassw");
$router->get("/esqueceu-senha", "ControllerLogin:forgotPassw");

$router->get("/lista-geral", "ControllerAfiliado:renderGeneralList");



$router->group("ops");
$router->get("/{errcode}", function ($data) {
    echo "<h1>Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
