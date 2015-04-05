<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 17:32
 */

namespace Example\Core;


abstract class BaseModel {
    protected $connection = null;
    public $id;

    public function __construct($conn) {
        $this->connection = $conn;
    }

    public function save() {
        // TODO: add validation
    }

    public function find($params) {

    }

    public function findOne($id) {

    }
}