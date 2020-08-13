<?php

namespace Source\Controllers;

require __DIR__ . "../../global/Controller.php";
require __DIR__ . "../../login/Login.php";

use CoffeeCode\Router\Router;
use Source\Models\Login;

class ControllerLogin extends Controller
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

            $login = (new Login)->verifyUserLogin($data['email'], $data['passw']);

            $url = $this->getUrlTypeUser();
            $message = "Email ou senha incorreta...";

            $response = array(
                "url" => $url,
                "message" => $message
            );

            echo json_encode($response);
        }

        return;
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
