<?php

use Matts\Container;

if(commandline!=null && commandline){
    require_once 'autoload.php';
}else{
    require_once '../autoload.php';
}

$container = new Container();

$controllers = array_slice(scandir(sourcedir . "/Controller"), 2);


function dump($args)
{
    var_dump($args);
}
