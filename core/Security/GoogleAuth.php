<?php
namespace Matts\Security;
use Google\Authenticator\GoogleAuthenticator;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class GoogleAuth
 * @package vendor\security
 *
 */
class GoogleAuth
{

    private $auth;

    public function __construct()
    {
        $this->auth = new GoogleAuthenticator();
    }

    public function generatePrivateKey(){
        return $this->auth->generateSecret();
    }

    public function validateToken($private, $token){
        return $this->auth->checkCode($private, $token);
    }

    public function generateToken($private){
        return $this->auth->getCode($private);
    }

}