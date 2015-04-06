<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 17:32
 */

namespace Example\Core;


use Example\Config\Database;

abstract class BaseModel {
    public $id = null;

    public function __construct($data = null) {
        //echo "new instance of address with data: ".print_r($data, true);
        $this->set($data);
    }

    public function set($data) {
        if ($data) {
            $params = get_object_vars($this);
            foreach ($data as $key=>$value) {
                if (array_key_exists($key, $params)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public static function table() {
        return end(explode('\\', get_called_class()));
    }

    public function save() {
        // saves record to storage
        $db = Database::connection();
        $params = get_object_vars($this);
        $table = static::table(); // late static binding to get subclass name

        // prepare statement
        $stmt = $db->prepare("INSERT OR REPLACE INTO ".$table." ( ".implode(",", array_keys($params))." ) VALUES ( :".implode(", :", array_keys($params))." )");

        $data = [];
        foreach ($params as $key=>$value) {
            $data[':'.$key] = $value;
        }

        try {
            $stmt->execute($data);
            if ($this->id === null) {
                $this->id = $db->lastInsertId();
            }
            return true;
        }
        catch (\Exception $e) {
            error_log('Caught exception while saving model '.$table.': '.$e->getMessage());
            $error = $e->getMessage();
            return $error;
        }
    }

    public static function find($id) {
        $db = Database::connection();
        $table = static::table();
        $stmt = $db->prepare("SELECT * FROM ".$table." WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            $class = get_called_class();
            return new $class($result);
        }
        else {
            return null;
        }
    }

    public static function findAll() {
        $db = Database::connection();
        $table = static::table();
        $stmt = $db->prepare("SELECT * FROM ".$table." WHERE 1");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (count($result)) {
            $objects = [];
            $class = get_called_class();
            foreach ($result as $row) {
                $objects[] = new $class($row);
            }
            return $objects;
        }
        else {
            return null;
        }
    }

    public static function delete($id) {
        $db = Database::connection();
        $table = static::table();
        $stmt = $db->prepare("DELETE FROM ".$table." WHERE id = ?");
        return $stmt->execute([$id]);
    }
}