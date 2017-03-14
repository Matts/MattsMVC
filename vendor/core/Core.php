<?php
use vendor\core\libs\DatabaseManager;
use vendor\core\util\AnnotationHelper;

require_once '../autoload.php';

$controllers = array_slice(scandir(sourcedir . "/Controller"), 2);
$annotationHelper = new AnnotationHelper();
$config_ini = parse_ini_file(basedir."/config.ini", true);
$db = new DatabaseManager($config_ini);

function dump($args)
{
    var_dump($args);
}
