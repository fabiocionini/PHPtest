<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 15:50
 */

namespace Example\Config;


class Database {

    public static function connection() {
        // Create (connect to) SQLite database in file
        $sqlite_db = new \PDO('sqlite:'.sys_get_temp_dir().DIRECTORY_SEPARATOR.'PHPtest.sqlite3');

        // Set error mode to exceptions
        $sqlite_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $sqlite_db;
    }
}