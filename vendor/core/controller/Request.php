<?php
namespace vendor\Core\Controller;


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