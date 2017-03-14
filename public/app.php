<?php
use Matts\Controller\Controller;
use Matts\Controller\Request;

define('commandline', false);
require_once "../core/Core.php";

if (!empty($_GET['path'])) {
    $path = explode('/', $_GET['path']);
} else {
    $path = [""];
}

$request = new Request($_REQUEST);
$handled = false;
foreach ($controllers as $controller) {
    if ($container->get('annotationHelper')->getPrefix($controller)->getRoute() == $path[0]) {
        $control = $container->get("directoryHelper")->getPath("controller", $controller);

        /**
         * @var $control Controller
         */
        $control = new $control();
        $control->setContainer($container);
        $control->handleRequest($request);
        $handled=true;
    }
}
if(!$handled){
    //Throw 404
}


