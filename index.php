<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/source/login/ControllerLogin.php";
require __DIR__ . "/source/afiliado/ControllerAfiliado.php";
require __DIR__ . "/source/chamada/ControllerChamada.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);
$router->namespace("Source\Controllers");

$router->group(null);

$router->get("/", "ControllerLogin:renderLogin");
$router->post("/", "ControllerLogin:logIn", "login.login");
$router->get("/esqueceu-senha", "ControllerLogin:renderForgotPassw");
$router->post("/esqueceu-senha", "ControllerLogin:forgotPassw", "login.forgotPassw");

$router->get("/sair", "ControllerLogin:loguot");

$router->group("admin");

$router->get("/lista-geral", "ControllerAfiliado:renderGeneralList");
$router->get("/cadastro-afiliado", "ControllerAfiliado:renderRegisterAffiliate");
$router->get("/ver-afiliado", "ControllerAfiliado:renderViewAffiliate");
$router->get("/editar-afiliado", "ControllerAfiliado:renderEditAffiliate");

$router->get("/lista-chamada", "ControllerChamada:renderAttendanceSheet");

$router->get("/cadastro-usuario", "ControllerLogin:renderRegisterUser");

$router->group("usuario");

$router->get("/chamada", function(){
    echo "<h1>Chamada</h1>";
});

$router->group("ops");
$router->get("/{errcode}", function ($data) {
    echo "<h1>Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
