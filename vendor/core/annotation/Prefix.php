<?php

namespace vendor\core\annotation;

/**
 * Interface Prefix
 * @package vendor\core\annotation
 *
 * @Annotation
 */
class Prefix extends Annotation
{
    public $route;

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }


}