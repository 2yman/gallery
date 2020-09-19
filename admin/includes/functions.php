<?php

function autoload($class)
{
    $class = strtolower($class);
    $path = "includes/{$class}.php";

    if (is_file($path) && !class_exists($class)) {
        include($path);
    }
}
spl_autoload_register('autoload');

function dnd($param)
{
    var_dump($param);
    die();
}




?>