<?php
namespace Controller;

use Matts\Annotations\Prefix;
use Matts\Annotations\Route;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class IndexController
 * @package Controller
 */
class IndexController extends Controller
{
    /**
     * @Route(route="")
     */
    public function indexAction(Request $request, $args){

        return $this->render('index.html.twig');
    }

    /**
     * @param Request $request
     * @return string
     *
     * @Route(route="test/$arg")
     */
    public function request(Request $request, $args)
    {
        dump($args);
    }
}