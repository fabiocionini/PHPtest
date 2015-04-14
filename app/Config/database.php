<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 15:50
 */

namespace Example\Config;


/**
 * Class Database
 *
 * provides a database connection
 *
 * @package app\Config
 */
class Database {

    /**
     * creates and returns a PDO DB connection
     *
     * @return \PDO object
     */
    public static function connection() {
        // Create (connect to) SQLite database in file
        $sqlite_db = new \PDO('sqlite:'.sys_get_temp_dir().'PHPtest.sqlite3'); // TODO: db file in config

        // Set error mode to exceptions
        $sqlite_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $sqlite_db;
    }
}