<?php namespace FabioCionini\ExampleCore\Persistence;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 19/04/15
 * Time: 07:49
 */


/**
 * Class DataMapper
 *
 * "The Data Mapper is a layer of software that separates the in-memory objects from the database.
 * Its responsibility is to transfer data between the two and also to isolate them from each other.
 * With Data Mapper the in-memory objects need not know even that there's a database present;
 * they need no SQL interface code, and certainly no knowledge of the database schema."
 * http://martinfowler.com/eaaCatalog/dataMapper.html
 *
 * @package FabioCionini\ExampleCore\Persistence
 */

abstract class DataMapper {
    protected $pdo;
    protected $model;
    protected $table;
    protected $primaryKey;

    /**
     * Initializes the data mapper only with the PDO object
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Sets the model name of the data mapper. Extracts table name from the model name.
     *
     * @param string $model
     */
    public function setModel($model) {
        $this->model = $model;
        $this->table = end(explode("\\", $model));
    }

    /**
     * Sets the primary key field name of the model.
     *
     * @param string $primaryKey
     */
    public function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }
}