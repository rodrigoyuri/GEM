<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;

class ControllerAffiliate extends ViewController
{
    /** @var Router */
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "html");
    }

    public function renderGeneralList()
    {
        return $this->renderView("/general-list");
    }
}