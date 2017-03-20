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
    /*
     * @Route(route="generate")
     */
    public function generateSecret(Request $request){
        dump($this->get('googleAuth')->generatePrivateKey());
    }

    /**
     * @Route(route="token")
     */
    public function generateToken(Request $request){
        //dump($request->getRequest());
        dump($this->get('googleAuth')->generateToken($request->getRequest()[1]));
    }

    /**
     * @Route(route="check")
     */
    public function checkToken(Request $request){
        dump($this->get('googleAuth')->validateToken($request->getRequest()[1], $request->getRequest()[2]));
    }


    /**
     * @Route(route="login/$test")
     */
    public function handleRequest(Request $request)
    {
        dump($this->get('googleAuth')->validateToken("WOVSCLT4ZW7WNXLQ", "913999"));
    }
}