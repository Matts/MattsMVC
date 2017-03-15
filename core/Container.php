<?php

namespace Matts;
use Matts\libs\DatabaseManager;
use Matts\util\AnnotationHelper;
use Matts\util\DirectoryHelper;
use Twig_Environment;
use Twig_Loader_Filesystem;

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
        $this->services['config'] = parse_ini_file(basedir."/config.ini", true);

        $this->services['annotationHelper'] = new AnnotationHelper();
        $this->services['directoryHelper'] = new DirectoryHelper();
        $this->services['databaseManager'] = new DatabaseManager($this->services['config']);

        $loader = new Twig_Loader_Filesystem(sourcedir.'\View');
        $twig = new Twig_Environment($loader, array(
            'cache' => basedir.'/cache',
            'debug' => debug
        ));

        $this->services['twig'] = $twig;
        $this->services['loader'] = $loader;
    }

    public function registerService($name, $service){
        $this->services[$name]=$service;
    }

    public function get($name){
        return $this->services[$name];
    }
}