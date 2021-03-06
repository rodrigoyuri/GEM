<?php

namespace Source\Controllers;

session_start();
class Controller
{
    private $path;
    private $extension;

    protected function init($package, $ext)
    {
        $this->path = $package;
        $this->extension = $ext;
    }

    protected function renderView($file, $array = null)
    {
        if (!is_null($array)) {
            foreach ($array as $var => $value) {
                ${$var} = $value;
            }
        }

        ob_start();
        include "{$this->path}{$file}.{$this->extension}";
        ob_flush();
    }

    /**
     * Deve retornar o tipo de usuario
     */
    protected function typeUser()
    {
        if (!empty($_SESSION['userLogin'])) {

            $objUser = $_SESSION['userLogin'];

            return $objUser->nm_tipo_usuario;
        }
        return null;
    }

    protected function getUrlTypeUser()
    {
        switch ($this->typeUser()) {
            case "A":
                return URL_BASE . "/admin/lista-geral";
                break;
            case "U":
                return URL_BASE . "/usuario/lista-chamada";
                break;
            default:
                return URL_BASE . "/";
                break;
        }
    }

    /**
     * Redireciona o usuario para sua Home
     * Util para impedir o acesso de um user comum ao painel administrativo
     */
    protected function toHomeTypeUser($folder, $ext)
    {
        switch ($this->typeUser()) {
            case "A":
                return $this->renderView("/lista-geral", [
                    'message' =>  "<h1>Bem Vindo Usuario ADM!!</h1>"
                ]);
                break;
            case "U":
                break;
            default:
                return URL_BASE . "/";
                break;
        }
    }

    protected function verify(string $type, string $route, string $routeError)
    {
        if($this->typeUser() === $type) {
            return $this->renderView($route);
        } else {
            header("LOCATION: ". URL_BASE . $routeError);
        }
    }
}
