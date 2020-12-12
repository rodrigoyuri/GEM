<?php

namespace Source\Controllers;

require __DIR__ . "../../afiliado/Afiliado.php";

use CoffeeCode\Router\Router;
use Source\Models\Afiliado;

class ControllerAfiliado extends Controller
{
    /** @var Router */
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }

    public function getAffiliate($data)
    {
        $afiliado = (new Afiliado)->showAffiliate($data["id"]);

        echo json_encode($afiliado);
    }

    public function renderGeneralList()
    {
        $this->verify("A", "/lista-geral", "/ops");
    }

    public function tableList($data)
    {
        $afiliado = (new Afiliado)->indexFilter($data);

        echo json_encode($afiliado);
    }

    public function renderRegisterAffiliate()
    {
        $this->verify("A", "/cadastro-afiliado", "/ops");
    }

    public function updateAffiliate($data)
    {
        $week = "";

        for ($x = 0; $x < count($data["week"]); $x++) {
            if ($data["week"][$x] != "") {
                $week .= $data["week"][$x] . ";";
            }
        }

        $data["week"] = $week;

        $id = $data["id"];
        unset($data["id"]);

        $data["data"] = date("Y-m-d", strtotime(str_replace("/", "-", $data["data"])));

        $afiliado = (new Afiliado)->updateAffiliate($id, $data);

        echo $afiliado;
    }
    
    public function deleteAffiliates($data) {

        $delete = (new Afiliado)->deleteAffiliate($data["id"]);
        
        if($delete){
            echo "Excluido com sucesso";
        }else{
            echo "Não foi possível excluir o usuário";
        }

    }

    public function registerAffiliate($data)
    {
        $week = "";

        for ($x = 0; $x < count($data["week"]); $x++) {
            if ($data["week"][$x] != "") {
                $week .= $data["week"][$x] . ";";
            }
        }

        $data["week"] = $week;

        $data["data"] = date("Y-m-d", strtotime(str_replace("/", "-", $data["data"])));
        $data["data_ingressao"] = date("Y-m-d", strtotime(str_replace("/", "-", $data["data_ingressao"])));

        $afiliado = (new Afiliado)->insertAffiliate($data);

        echo $afiliado;
    }

    public function registerItem($data)
    {
        $afiliado = (new Afiliado)->insertItem($data);

        echo $afiliado;
    }

    public function getItem($data)
    {
        $afiliado = (new Afiliado)->showItems($data["id"]);

        echo json_encode($afiliado);
    }

    public function deleteItems($data)
    {
        $delete = (new Afiliado)->deleteItem($data["codigoItem"]);
        
        if($delete){
            echo "Excluido com sucesso";
        }else{
            echo "Não foi possível excluir o item";
        }
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
