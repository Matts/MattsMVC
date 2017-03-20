<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/16/2017
 * Time: 2:55 PM
 */

namespace Matts\Annotations;

/**
 * Class Route
 * @package Matts\Annotations
 *
 * @Annotation
 */
class Route
{
    public $route;
    public $method = "GET";

    public function getRoute()
    {
        return $this->route;
    }
}