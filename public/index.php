<?php

$dirRoot = str_replace(["public", "\\"], ["", "/"], __DIR__);
define("__DIR_ROOT__", $dirRoot);

use App\App;

require_once "../vendor/autoload.php";

new App;
