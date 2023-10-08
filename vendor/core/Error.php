<?php

namespace Core;

class Error
{
    public static function render($data = [], $name = "404")
    {
        extract($data);
        $pathView = "../resources/views/errors/$name.blade.php";
        if (file_exists($pathView)) {
            require_once $pathView;
            die;
        }
        echo "Kiem tra lai duong dan";
        die;
    }
}
