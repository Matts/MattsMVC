<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/14/2017
 * Time: 4:42 PM
 */

namespace vendor\core\libs;


class DatabaseManager extends \PDO
{
    public function __construct($config_ini)
    {
        parent::__construct("mysql:host=" . $config_ini['database_settings']['database_host'] . ";dbname=" . $config_ini['database_settings']['database'], $config_ini['database_settings']['database_user'], $config_ini['database_settings']['database_password']);
    }
}