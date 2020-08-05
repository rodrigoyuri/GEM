<?php

namespace Source\Controllers;

//require __DIR__ . "../../global/ViewController.php";

use CoffeeCode\Router\Router;

class ControllerLogin extends ViewController
{

    /** @var Router */
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "html");
    }

    public function renderLogin()
    {
        return $this->renderView("/login");
    }
}