<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;

class ControllerAfiliado extends ViewController
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
        //Colocar verificação de tipo de usuario aqui
        return $this->renderView("/lista-geral");
    }
}
