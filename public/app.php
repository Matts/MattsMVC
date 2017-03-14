<?php
use vendor\Core\Controller\Controller;
use vendor\Core\controller\Request;
use vendor\core\util\ReflectionHelper;

require_once "../vendor/core/Core.php";

if (!empty($_GET['path'])) {
    $path = explode('/', $_GET['path']);
} else {
    $path = [""];
}

$request = new Request($_REQUEST);
foreach ($controllers as $controller) {
    if ($annotationHelper->getPrefix($controller)->getRoute() == $path[0]) {
        $control = ReflectionHelper::getControllerFromFileName($controller);

        /**
         * @var $control Controller
         */
        $control = new $control();
        $control->handleRequest($request);
    }
}


