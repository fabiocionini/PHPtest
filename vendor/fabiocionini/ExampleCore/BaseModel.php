<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:32
 */

namespace FabioCionini\ExampleCore;


/**
 * Class BaseModel
 * An abstract, Active Record based class that handles an object lifecycle
 * Override $db_config to init database
 *
 * @package FabioCionini\ExampleCore
 */
abstract class BaseModel {

    public $id = null;
    protected $db_config = []; // this will be overridden in concrete classes to access db

    /**
     * @param array $data
     */
    public function __construct($data = null) {
        $this->set($data);
    }

    /**
     * Returns id and other public properties defined by model class
     * @return array
     */
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

    /**
     * Sets model instance properties
     * @param $data
     */
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

    /**
     * Get current model class name (called with late static binding to get subclass name)
     * @return string
     */
    public static function table() {
        return end(explode('\\', get_called_class()));
    }

    /**
     * Saves the object into DB storage
     * Returns true if success, otherwise returns the error
     * @return bool|string
     */
    public function save() {
        // saves record to storage
        $db = Database::connection($this->db_config);
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

    /**
     * Static class that retrieves an object by id, null if not found
     * @param $id
     * @return Object|null
     */
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

    /**
     * Static class that retrieves all objects, null if there are none
     * @return array|null
     */
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

    /**
     * Static class that deletes an object by id
     * @param $id
     * @return bool
     */
    public static function delete($id) {
        $db = Database::connection();
        $table = static::table();
        $stmt = $db->prepare("DELETE FROM ".$table." WHERE id = ?");
        return $stmt->execute([$id]);
    }
}