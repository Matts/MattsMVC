<?php
namespace Matts;

use Assetic\Asset\GlobAsset;
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Extension\Twig\AsseticExtension;
use Assetic\Extension\Twig\TwigFormulaLoader;
use Assetic\Extension\Twig\TwigResource;
use Assetic\Factory\AssetFactory;
use Assetic\Factory\LazyAssetManager;
use Assetic\FilterManager;
use Matts\Libraries\DatabaseManager;
use Matts\util\AnnotationHelper;
use Matts\util\DirectoryHelper;
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
    private $services = [];

    public function __construct()
    {
        $this->services['config'] = parse_ini_file(basedir . "/config.ini", true);

        $this->services['annotationHelper'] = new AnnotationHelper();
        $this->services['directoryHelper'] = new DirectoryHelper();
        $this->services['databaseManager'] = new DatabaseManager($this->services['config']);

        $loader = new Twig_Loader_Filesystem(sourcedir . '/View');
        $twig = new Twig_Environment($loader, array(
            'cache' => basedir . '/cache',
            'debug' => defined('debug') && debug,

        ));


        // Init Assetic
        /*$FilterManager = new FilterManager();
        $AssetFactory = new AssetFactory(sourcedir.'/Asset');
        $AssetFactory->setAssetManager(new AssetManager());
        $AssetFactory->setFilterManager($FilterManager);
        $AssetFactory->setDebug(debug);

// Enable Assetic extension in Twig
        $twig->addExtension(new AsseticExtension($AssetFactory));

// Render a page
        $Template = $twig->loadTemplate("index.html.twig");
        echo $Template->render(['url'=>"test"]);

// Dump compiled assets - THIS IS MOST PROBABLY COMPLETELY WRONG???
        $AssetManager = new LazyAssetManager($AssetFactory);
        $AssetManager->setLoader('twig', new TwigFormulaLoader($twig));
        $resource = new TwigResource($twig->getLoader(), $Template);
        $AssetManager->addResource($resource, 'twig');


        $writer = new AssetWriter('../public');

        $writer->writeManagerAssets($AssetManager);*/

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