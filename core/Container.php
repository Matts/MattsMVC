<?php

namespace Matts;
use Matts\libs\DatabaseManager;
use Matts\util\AnnotationHelper;
use Matts\util\DirectoryHelper;

/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 3/14/2017
 * Time: 9:21 PM
 */
class Container
{
    private $services = [];

    public function __construct()
    {
        $config_ini = parse_ini_file(basedir."/config.ini", true);

        $this->services['annotationHelper'] = new AnnotationHelper();
        $this->services['directoryHelper'] = new DirectoryHelper();
        $this->services['databaseManager'] = new DatabaseManager($config_ini);
    }

    public function registerService($name, $service){
        $this->services[$name]=$service;
    }

    public function get($name){
        return $this->services[$name];
    }
}