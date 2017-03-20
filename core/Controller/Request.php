<?php
namespace Matts\Controller;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class Request
 * @package vendor\core\Controller
 *
 */
class Request
{
    private $post;
    private $get;
    private $cookies;

    /**
     * Request constructor.
     * @param $post
     * @param $get
     * @param $session
     * @param $cookies
     */
    public function __construct($post, $get, $cookies)
    {
        $this->post = $post;
        $this->get = $get;
        $this->cookies = $cookies;
    }


    public function getURL(){
        return explode("/", $this->get['path']);
    }

    public function getPost(){
        return $this->post;
    }

    public function getCookies(){
        return $this->cookies;
    }





}