<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 17/04/15
 * Time: 10:42
 */

namespace FabioCionini\ExampleCore;


/**
 * Class Database
 *
 * provides a database singleton object
 * available drivers: SQLite
 *
 * @package FabioCionini\ExampleCore
 */
class Database {

    /**
     * creates and returns a PDO DB connection
     *
     * @param Array $config the database configuration
     * @return \PDO object
     */

    public static function connection($config) {

        $db = null;

        if (array_key_exists('driver', $config) && array_key_exists($config['driver'], $config['config'])) {
            switch($config['driver']) {
                case 'sqlite':
                    $db = new \PDO('sqlite:'.$config['config']['sqlite']['filename']);
                    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    break;
                default:
                    break;
            }
        }

        return $db;
    }
}