<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 3/14/2017
 * Time: 7:18 PM
 */

namespace Matts\util;


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