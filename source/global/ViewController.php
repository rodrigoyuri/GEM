<?php

namespace Source\Controllers;

class ViewController
{
    private $path;
    private $extension;

    protected function init($package, $ext)
    {
        $this->path = $package;
        $this->extension = $ext;
    }

    protected function renderView($arquivo, $array = null)
    {
        if(!is_null($array)) {
            foreach ($array as $var => $value) {
                ${$var} = $value;
            }
        }

        ob_start();
        include "{$this->path}{$arquivo}.{$this->extension}";
        ob_flush();
    }
}