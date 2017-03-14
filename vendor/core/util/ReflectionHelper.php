<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/14/2017
 * Time: 4:27 PM
 */

namespace vendor\core\util;


class ReflectionHelper
{
    public static function getControllerFromFileName($filename){
        return 'src\Controller\\' . explode('.', $filename)[0];
    }
}