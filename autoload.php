<?php
use Doctrine\Common\Annotations\AnnotationRegistry;

define('basedir', __DIR__);
define('sourcedir', __DIR__."/src");
define('webdir', __DIR__."/public");
define('coredir', __DIR__."/core");
define('vendordir', __DIR__."/vendor");

$autoloader = require_once 'vendor/autoload.php';
if(!commandline){
AnnotationRegistry::registerLoader(array($autoloader, 'loadClass'));
}