<?php
namespace Matts\Util;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\AnnotationReader;
use Matts\Annotations\Permission;
use Matts\Annotations\Prefix;
use Matts\Annotations\Route;
use ReflectionClass;
use ReflectionMethod;

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

    public function getAnnotationsFromMethod($class, $method){
        $annotations = [];
        $reader = new AnnotationReader();
        foreach ($reader->getMethodAnnotations(new ReflectionMethod($class,$method)) as $annotation){
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

    public function getMethods($controller){
        $class = new ReflectionClass(DirectoryHelper::getPath("controller", $controller));
        return $class->getMethods();
    }

    public function getRoute($controller, $method){
        $annotations = $this->getAnnotationsFromMethod(DirectoryHelper::getPath("controller", $controller), $method);
        foreach ($annotations as $annotation){
            if($annotation instanceof Route){
                return $annotation;
            }
        }
        return null;
    }

    public function getPermission($controller, $method){
        $annotations = $this->getAnnotationsFromMethod(DirectoryHelper::getPath("controller", $controller), $method);
        foreach ($annotations as $annotation){
            if($annotation instanceof Permission){
                return $annotation;
            }
        }
        return null;
    }

}