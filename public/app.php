<?php
use Matts\Annotations\Route;
use Matts\Controller\Request;
session_start();
define('parent', 'app');

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli-server')
) {
    define('debug', false);
} else {
    define('debug', true);
}

require_once "../core/Core.php";



if (!empty($_GET['path'])) {
    $path = explode('/', $_GET['path']);
} else {
    $path = [""];
}
for ($i=0;$i<sizeof($path);$i++){
    if(strlen($path[$i])<1){
        $path[$i]=null;
    }
    $path = array_filter($path);
}

$request = new Request($_POST, $_GET, $_COOKIE, $_SERVER['REQUEST_METHOD']);
$handled = false;

foreach ($controllers as $controller) {
    $methods = ($container->get('annotationHelper')->getMethods($controller));
    foreach ($methods as $method) {

        $route = ($container->get("annotationHelper")->getRoute($controller, $method->getName()));

        if ($route instanceof Route) {
            $routeTemplate = explode('/', $route->getRoute());

            for ($i=0;$i<sizeof($routeTemplate);$i++){
                if(strlen($routeTemplate[$i])<1){
                    $routeTemplate[$i]=null;
                }
                $routeTemplate = array_filter($routeTemplate);
            }
            
            $args = [];
            $matches = false;
            if($route->method == $_SERVER['REQUEST_METHOD']){

            if (sizeof($routeTemplate) == sizeof($path)) {
                for ($i = 0; $i < sizeof($routeTemplate); $i++) {
                    if ($routeTemplate[$i] == $path[$i]) {
                        $matches = true;
                    } else {
                        if (substr($routeTemplate[$i], 0, 1) == "$") {
                            $args[substr($routeTemplate[$i], 1, strlen($routeTemplate[$i]))] = $path[$i];
                            $matches = true;
                        } else {
                            $matches = false;
                            break;
                        }
                    }
                }

                }
            }


            if ($matches) {
                $methodname = $method->getName();
                $control = $container->get("directoryHelper")->getPath("controller", $controller);
                $control = new $control();
                $control->setContainer($container);
                echo $control->$methodname($request, $args);
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
if (!$handled) {
    echo "ERR";
}


