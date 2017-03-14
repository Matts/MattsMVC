<?php
namespace vendor\core\util;

use ReflectionClass;
use vendor\core\annotation\Prefix;

/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/14/2017
 * Time: 3:22 PM
 */
class AnnotationHelper
{
    public function getAnnotationsFromClass($std)
    {
        $annotations = [];
        $reflectionClass = new ReflectionClass($std);
        preg_match_all("#@(.*?)\n#s", $reflectionClass->getDocComment(), $matches);
        foreach ($matches as $ann) {

            foreach ($ann as $a) {
                if (substr($a, 0, 1) === '@') {
                    preg_match_all('/@([\\\\\w]+)\((?:|(.*?[]"}]))\)/', $a, $matches, PREG_SET_ORDER, 0);
                    $matches = $matches[0];
                    $classname = "vendor\\core\\annotation\\{$matches[1]}";
                    if (@class_exists($classname, true)) {
                        $annotation = new $classname();
                        $args = explode("=",$matches[2]);
                        $args = str_replace("\"", "", $args);
                        $annotation->__set($args[0], $args[1]);
                        $annotations[] = $annotation;
                    }
                }
            }
        }
        return $annotations;
    }

    public function getPrefix($controller){
        $annotations = $this->getAnnotationsFromClass('src\Controller\\'.explode('.', $controller)[0]);
        foreach ($annotations as $annotation){
            if($annotation instanceof Prefix){
                return $annotation;
            }
        }
        return null;
    }
}