<?php
namespace Matts\util;

use Doctrine\Common\Annotations\AnnotationReader;
use Matts\Annotations\Annotation;
use Matts\Annotations\Prefix;
use ReflectionClass;

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
        $reader = new AnnotationReader();

        foreach ($reader->getClassAnnotations(new ReflectionClass($std)) as $annotation){
            $annotations[] = $annotation;
        }

        return $annotations;
    }

    public function getPrefix($controller){
        $annotations = $this->getAnnotationsFromClass(DirectoryHelper::getPath("controller", $controller));
        foreach ($annotations as $annotation){
            if($annotation instanceof Prefix){
                return $annotation;
            }
        }
        return null;
    }
}