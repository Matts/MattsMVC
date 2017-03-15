<?php
namespace Matts\Libraries;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class DatabaseManager
 * @package vendor\libraries
 *
 */
class DatabaseManager extends \PDO
{
    private $em;

    public function __construct($config_ini)
    {
        $paths = array("src/Entity");
        $isDevMode = false;

        // the connection configuration
        $dbParams = array(
            'driver' => $config_ini['database_settings']['database_driver'],
            'user' => $config_ini['database_settings']['database_user'],
            'password' => $config_ini['database_settings']['database_password'],
            'host' => $config_ini['database_settings']['database_host'],
            'dbname' => $config_ini['database_settings']['database'],
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

        $this->em = EntityManager::create($dbParams, $config);
    }

    public function getEntityManager()
    {
        return $this->em;
    }
}