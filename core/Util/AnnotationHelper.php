<?php
namespace Matts\Util;

use Doctrine\Common\Annotations\AnnotationReader;
use Matts\Annotations\Prefix;
use ReflectionClass;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class AnnotationHelper
 * @package vendor\util
 *
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