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
    private $request;

    function __construct($request)
    {
        $this->request=$request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }




}