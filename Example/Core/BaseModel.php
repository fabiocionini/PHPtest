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
    //public $rules = [];

    public function __construct($data = null) {
        $this->set($data);
    }

    private function get_model_vars() {
        $reflection = new \ReflectionObject($this);
        $class = get_called_class();
        $properties = get_object_vars($this);
        $model_vars = [];
        foreach ($properties as $key=>$value) {
            if ($key === 'id' || $reflection->getProperty($key)->getDeclaringClass()->getName() === $class) {
                $model_vars[$key] = $value;
            }
        }
        return $model_vars;
    }

    public function set($data) {
        if ($data) {
            $params = $this->get_model_vars();
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
        $params = $this->get_model_vars();
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