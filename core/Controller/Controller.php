<?php
namespace Matts\Controller;

use Matts\Container;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class Controller
 * @package vendor\core\controller
 *
 */
class Controller
{
    private $container;

    public function render($filename, $parameters = array()){
        /**
         * @var $twig \Twig_Environment
         */
        $twig = $this->get('twig');
        return $twig->render($filename, $parameters);
    }

    public function setContainer(Container $container){
        $this->container = $container;
    }

    public function get($service){
        return $this->container->get($service);
    }
}