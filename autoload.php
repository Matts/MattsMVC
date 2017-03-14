<?php
define('basedir', __DIR__);
define('sourcedir', __DIR__."/src");
define('webdir', __DIR__."/public");

spl_autoload_register(function ($class) {
    include $class . '.php';
});