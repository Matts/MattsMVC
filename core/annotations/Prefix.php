<?php

namespace Matts\Annotations;

/**
 * Interface Prefix
 * @package vendor\core\annotations
 *
 * @Annotation
 */
class Prefix
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