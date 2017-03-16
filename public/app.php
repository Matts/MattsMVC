<?php
use Controller\IndexController;
use Matts\Annotations\Route;
use Matts\Controller\Controller;
use Matts\Controller\Request;
use Matts\Util\DirectoryHelper;

define('parent', 'app');

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli-server')
) {
    define('debug', false);
}else{
    define('debug', true);
}


require_once "../core/Core.php";

if (!empty($_GET['path'])) {
    $path = explode('/', $_GET['path']);
} else {
    $path = [""];
}

$request = new Request($_REQUEST);
$handled = false;

foreach ($controllers as $controller){
    $methods = ($container->get('annotationHelper')->getMethods($controller));
    foreach ($methods as $method){
        $route = ($container->get("annotationHelper")->getRoute($controller, $method->getName()));
        if($route instanceof Route){
            if($route->getRoute() == $path[0]){
                $methodname = $method->getName();
                $control = $container->get("directoryHelper")->getPath("controller", $controller);
                $control = new $control();
                $control->setContainer($container);
                echo $control->$methodname($request);
                $handled = true;
            }
        }

    }
}

/*foreach ($controllers as $controller) {
    if ($container->get('annotationHelper')->getPrefix($controller)->getRoute() == $path[0]) {
        $control = $container->get("directoryHelper")->getPath("controller", $controller);

        /**
         * @var $control Controller
         */
        /*$control = new $control$();
        $control->setContainer($container);
        $handle = $control->handleRequest($request);
        if($handle == null){
            throw new Exception("Must have return");
        }else{
            echo $handle;
        }
        $handled=true;
    }
}*/
if(!$handled){
    echo "ERR";
}


