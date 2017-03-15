<?php
use Matts\Container;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class AnnotationHelper
 * @package vendor\util
 *
 */


if(!defined("parent")){
    @define('commandline', true);
}else{
    @define('commandline', false);
}

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
