<?php
namespace Controller;

use Matts\Annotations\Prefix;
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
 *
 * @Prefix(route="")
 */
class IndexController extends Controller
{
        public function handleRequest(Request $request)
        {
            return $this->render('index.html.twig');
        }
}