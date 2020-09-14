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
        return $this->renderView("/login");
    }

    public function getUsers()
    {
        $logins = (new Login)->indexUsers();

        echo json_encode($logins);
    }

    public function registerUser($data)
    {
        $data["senha"] = password_hash($data["senha"], PASSWORD_DEFAULT);

        $login = (new Login)->insertUser($data);

        if ($login) {
            echo "Cadastrado com Sucesso";
        } else {
            echo "Falha ao realizar o Cadastro";
        }
    }

    public function removeUser($data)
    {
        $login = (new Login)->deleteUser($data["id"]);

        echo json_encode($login);
    }

    public function logIn(array $data)
    {
        if ($data) {

            $login = (new Login)->verifyUserLogin($data['email'], $data['passw']);

            $url = $this->getUrlTypeUser();
            $message = "Email ou senha incorreta...";

            $response = array(
                "url" => $url,
                "message" => $message,
                "extra" => $login
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
                $response = array("url" => URL_BASE . "/esqueceu-senha", "message" => "Uma nova senha foi enviada para o seu email", "extra" => $verifyUser);
            } else {
                $response = array("url" => URL_BASE . "/esqueceu-senha", "message" => "E-mail informado não está cadastrado", "extra" => $verifyUser);
            }

            echo json_encode($response);
        }

        return;
    }

    public function loguot()
    {
        $_SESSION['userLogin'] = array();

        if (ini_get("session.use_cookies")) {
            $param = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $param["path"],
                $param["domain"],
                $param["secure"],
                $param["httponly"]
            );
        }

        session_destroy();

        header("LOCATION: " . URL_BASE);
    }
}
