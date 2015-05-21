<?php
/**
 * Created by IntelliJ IDEA.
 * User: fabio
 * Date: 21/05/15
 * Time: 22:34
 */

namespace FabioCionini\ExampleCore\Persistence;


interface MapperInterface {
    /**
     * Retrieves an object by its primary key, null if not found
     *
     * @param $pk
     * @return Object|null
     */
    public function find($pk);

    /**
     * Retrieves all objects, null if there are none
     *
     * @return array|null
     */
    public function findAll();

    /**
     * Saves the object into DB storage (or updates it if it exists)
     * Returns true if success, otherwise returns the error
     *
     * @param MappableObject $object
     * @return bool|string
     */
    public function insertOrUpdate(MappableObject $object);

    /**
     * Deletes an object by primary key
     *
     * @param $pk
     * @return bool
     */
    public function delete($pk);
}