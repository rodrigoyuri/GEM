<?php

namespace Source\Controllers;

require __DIR__ . "../../global/ViewController.php";
require __DIR__ . "../../login/Login.php";

use CoffeeCode\Router\Router;
use Source\Models\Login;

class ControllerLogin extends ViewController
{

    /** @var Router */
    // private $router;

    public function __construct($router)
    {
        $this->router = $router;
        parent::init(__DIR__ . "/view", "php");
    }

    public function renderLogin()
    {
        return $this->renderView("/login", ["data" => ""]);
    }

    public function logIn(array $data)
    {
        if ($data) {
            //var_dump($data);
            $login = new Login();

            $verifyLogin = $login->verifyUserLogin($data['email'], $data['passw']);

            $url = URL_BASE . "/";
            $message = "Email ou senha incorreta...";

            if ($verifyLogin) {
                $url = URL_BASE . "/lista-geral"; // METODO PARA RETORNAR A PAGINA DEPENDENDO DO TIPO DE USUARIO ??
                $message = "";
            }

            $response = array(
                "url" => $url,
                "message" => $message
            );

            echo json_encode($response);
        }

        //return;
    }

    public function renderForgotPassw()
    {
        return $this->renderView("/esqueceu-senha");
    }

    public function forgotPassw($data)
    {
        if ($data) {

            $login = new Login();

            $verifyUser = $login->resetPassword($data["email"]);

            if ($verifyUser) {
                $response = array("message" => "Uma nova senha foi enviada para o seu email");
            } else {
                $response = array("message" => "E-mail informado não está cadastrado");
            }

            echo json_encode($response);
        }

        return;
    }
}
