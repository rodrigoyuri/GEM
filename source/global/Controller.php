<?php

namespace Source\Controllers;

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
        if ($_SESSION['userLogin']) {

            $objUser = $_SESSION['userLogin'];

            return $objUser->typeuser;
        } else {
            return null;
        }
    }

    /**
     * Redireciona o usuario para sua Home
     * Util para impedir o acesso de um user comum ao painel administrativo
     */
    protected function toHomeTypeUser()
    {
        switch ($this->typeUser()) {
            case 'A':
                return $this->renderView("/home-user", [
                    'message' =>  "<h1>Bem Vindo Usuario ADM!!</h1>"
                ]);
                break;

            case 'C':
                break;
            case 'I':
                break;
            default:
                header("LOCATION:" . URL_BASE . "/");
                break;
        }
    }
}
