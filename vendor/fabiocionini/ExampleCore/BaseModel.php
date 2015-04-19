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

    public $id;

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
    public function get_model_vars() {
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
}