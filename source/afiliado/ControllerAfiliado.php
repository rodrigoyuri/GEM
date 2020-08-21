<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;

class ControllerAfiliado extends Controller
{
    /** @var Router */
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }

    public function renderGeneralList()
    {
        $this->verify("A", "/lista-geral", "/ops");
    }

    public function renderRegisterAffiliate()
    {
        $this->verify("A", "/cadastro-afiliado", "/ops");
    }

    public function renderViewAffiliate()
    {
        $this->verify("A", "/ver-afiliado", "/ops");
    }

    public function renderEditAffiliate()
    {
        $this->verify("A", "/editar-afiliado", "/ops");
    }
}
