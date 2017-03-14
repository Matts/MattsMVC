<?php

namespace Matts\Controller;


use Matts\Container;

class Controller
{
    private $container;

    public function handleRequest(Request $request){
        echo "Default Handling";
    }

    public function render($filename){
        include sourcedir . "/View/" . $filename;
    }

    public function setContainer(Container $container){
        $this->container = $container;
    }

    public function get($service){
        return $this->container->get($service);
    }
}