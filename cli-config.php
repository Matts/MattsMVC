<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
define('commandline', true);
require_once 'core/Core.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->get('databaseManager')->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
