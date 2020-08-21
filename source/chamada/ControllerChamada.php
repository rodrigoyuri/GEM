<?php

namespace Source\Controllers;

class ControllerChamada extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }
    public function renderAttendanceSheet()
    {
        return $this->renderView("/lista-chamada");
    }
}