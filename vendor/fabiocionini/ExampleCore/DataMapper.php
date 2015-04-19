<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 19/04/15
 * Time: 07:49
 */

namespace FabioCionini\ExampleCore;

/**
 * Class DataMapper
 *
 * "The Data Mapper is a layer of software that separates the in-memory objects from the database.
 * Its responsibility is to transfer data between the two and also to isolate them from each other.
 * With Data Mapper the in-memory objects need not know even that there's a database present;
 * they need no SQL interface code, and certainly no knowledge of the database schema."
 * http://martinfowler.com/eaaCatalog/dataMapper.html
 *
 * @package FabioCionini\ExampleCore
 */
abstract class DataMapper {
    private $pdo;
    private $modelName;
    private $primaryKey;
    private $className;

    public function __construct($pdo, $modelName, $primaryKey = 'id', $namespace) {
        $this->pdo = $pdo;
        $this->modelName = $modelName;
        $this->className = $namespace.'\\'.$modelName;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Retrieves an object by its primary key, null if not found
     * @param $pk
     * @return Object|null
     */
    public function find($pk) {
        $stmt = $this->pdo->prepare("SELECT * FROM ".$this->modelName." WHERE ".$this->primaryKey." = ?");
        $stmt->execute([$pk]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new $this->className($result);
        }
        else {
            return null;
        }
    }

    /**
     * Retrieves all objects, null if there are none
     * @return array|null
     */
    public function findAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM ".$this->modelName." WHERE 1");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (count($result)) {
            $objects = [];
            foreach ($result as $row) {
                $objects[] = new $this->className($row);
            }
            return $objects;
        }
        else {
            return null;
        }
    }

    /**
     * Deletes an object by primary key
     * @param $pk
     * @return bool
     */
    public function delete($pk) {
        $stmt = $this->pdo->prepare("DELETE FROM ".$this->modelName." WHERE ".$this->primaryKey." = ?");
        return $stmt->execute([$pk]);
    }

    /**
     * Saves the object into DB storage (or updates it if it exists)
     * Returns true if success, otherwise returns the error
     * @param Object (BaseModel) $object
     * @return bool|string
     */
    public function insertOrUpdate($object) {
        // prepare statement
        $params = $object->get_model_vars();
        $stmt = $this->pdo->prepare("INSERT OR REPLACE INTO ".$this->modelName." ( ".implode(",", array_keys($params))." ) VALUES ( :".implode(", :", array_keys($params))." )");

        $data = [];
        foreach ($params as $key=>$value) {
            $data[':'.$key] = $value;
        }

        try {
            $stmt->execute($data);
            if ($object->id === null) {
                $object->id = $this->pdo->lastInsertId();
            }
            return true;
        }
        catch (\Exception $e) {
            error_log('Caught exception while saving model instance of '.$this->modelName.': '.$e->getMessage());
            $error = $e->getMessage();
            return $error;
        }
    }

}