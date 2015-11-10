<?php namespace ChrisKonnertz\OpenGraph;

use Exception;

class OpenGraphTag {

    /**
     * The name of the tag
     * @var string
     */
    protected $name;

    /**
     * The value of the tag
     * @var mixed
     */
    protected $value;

    /**
     * Add the "og"-prefix?
     * @var boolean
     */
    protected $prefixed;

    /**
     * Constructor call.
     * 
     * @param string  $name     The name of the tag
     * @param mixed   $value    The value of the tag
     * @param boolean $prefixed Add the "og"-prefix?
     */
    public function __construct($name, $value, $prefixed = true) 
    {
        $this->setAttribute('name', $name);
        $this->setAttribute('value', $value);
        $this->setAttribute('prefixed', $prefixed);
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    /**
     * Sets an objet attribute to a value.
     * 
     * @param string $name  The name of the object attribute
     * @param mixed  $value The value of the object attribute
     */
    protected function setAttribute($name, $value) 
    {
        // Convert values
        switch ($name) {
            case 'name':
            case 'value':
                $value = (string) $value;
                break;
            case 'prefixed':
                $value = (boolean) $value;
                break;
        }

        $this->$name = $value;
    }

}