<?php
namespace Matts;


use Matts\Libraries\DatabaseManager;
use Matts\util\AnnotationHelper;
use Matts\util\DirectoryHelper;

use Twig\AssetExtension;
use Twig_Environment;
use Twig_Loader_Filesystem;

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
class Container
{
    /**
     * @var AnnotationHelper $services['annotationHelper']
     */
    private $services = [];
    private $base;

    public function __construct()
    {


        $this->base = explode("app.php",$_SERVER['PHP_SELF'])[0];
        $this->services['config'] = parse_ini_file(basedir . "/config.ini", true);

        $this->services['annotationHelper'] = new AnnotationHelper();
        $this->services['directoryHelper'] = new DirectoryHelper();
        $this->services['databaseManager'] = new DatabaseManager($this->services['config']);

        $loader = new Twig_Loader_Filesystem(sourcedir . '/View');
        $twig = new Twig_Environment($loader, array(
            'cache' => basedir . '/cache',
            'debug' => defined('debug') && debug,

        ));

        $twig->addFunction(new \Twig_SimpleFunction('assets', function($url){
            return $this->base.$url;
        }));

        $this->services['twig'] = $twig;
        $this->services['loader'] = $loader;


    }

    public function registerService($name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get($name)
    {
        return $this->services[$name];
    }
}