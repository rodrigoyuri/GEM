<?php

namespace Source\Controllers;

require __DIR__ . "../../global/ViewController.php";
require __DIR__ . "../../login/Login.php";

use CoffeeCode\Router\Router;
use Source\Models\Login;

class ControllerLogin extends ViewController
{

    /** @var Router */
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }

    public function renderLogin()
    {
        $login = new Login();

        $logins = $login->renderLoginUsers();

        return $this->renderView("/login", [
            "data" => $logins
        ]);
    }
}