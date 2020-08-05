<?php

namespace Source\Models;

require __DIR__ . "../../global/Crud.php";
require __DIR__ . "../../global/Connection.php";

use Source\Crud\Crud;

class Login extends Crud
{
    public function renderLoginUsers()
    {
        $select = parent::select("*")->from("login")->execute("fetchAll");

        return $select;
    }
}