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
 * Class LoginController
 * @package Controller
 *
 */
class LoginController extends Controller
{
    /**
     * @Route(route="login")
     */
    public function handleRequest(Request $request)
    {
        dump($this->get('googleAuth')->validateToken("WOVSCLT4ZW7WNXLQ", "913999"));
    }
}