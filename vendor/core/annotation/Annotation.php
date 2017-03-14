<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/14/2017
 * Time: 3:45 PM
 */

namespace vendor\core\annotation;


class Annotation
{
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->$name)) {
            return $this->$name;
        }
    }

}