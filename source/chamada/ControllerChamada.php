<?php

namespace Source\Controllers;

require __DIR__ . "../../chamada/Chamada.php";

use CoffeeCode\Router\Router;
use Source\Models\Chamada;

class ControllerChamada extends Controller
{
    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }

    public function getAffiliates($data)
    {

        $affiliates = (new Chamada)->indexFilter($data);

        echo json_encode($affiliates);
    }

    public function renderGeneralList()
    {
        $this->verify("A", "/lista-chamada", "/ops");
    }

    public function renderAttendanceSheet()
    {
        if ($this->typeUser() === "A" || $this->typeUser() === "U")
            return $this->renderView("/lista-chamada");
        else {
            header("LOCATION: " . URL_BASE . "/ops");
        }
    }

    public function updatePresent($data)
    {
        $codPresents = json_decode($data["data"]);

        $affiliates = (new Chamada)->updatePresent($codPresents);

        return var_dump($affiliates);
    }

    public function statusAffiliate($data)
    {
        $affiliates = (new Chamada)->toggleAffiliate($data["id"]);

        echo json_encode($affiliates);
    }
}
