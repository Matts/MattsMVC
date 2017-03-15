<?php
namespace Matts\Util;

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
class DirectoryHelper
{
    private static $sourceDirectories =
        [
            "controller"=>'Controller',
            "model"=>'Model',
            "view"=>'View',

            "annotations"=>'Matts\annotation'
        ];

    public function getPath($type, $file){
        if(strpos($file, '.php') !== false){
            $file = explode('.', $file)[0];
        }
        if(isset(DirectoryHelper::$sourceDirectories[$type])){
            return DirectoryHelper::$sourceDirectories[$type] . '\\' .$file;
        }
        return false;

    }

}