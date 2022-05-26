<?php

spl_autoload_register(function($className) {
    $path = __DIR__ . "/src/" . str_replace("\\", "/", $className) . ".php";
    require($path);
});

$obj1 = new A_class\A_object();
$obj1->mess();

$obj2 = new B_class\B_object();
$obj2->mess();