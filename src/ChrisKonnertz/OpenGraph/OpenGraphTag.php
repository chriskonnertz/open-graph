<?php 

namespace ChrisKonnertz\OpenGraph;

use Exception;

/**
 * Class that represents n open graph tag
 */
class OpenGraphTag {

    /**
     * The name of the tag
     *
     * @var string
     */
    protected $name;

    /**
     * The value of the tag
     *
     * @var mixed
     */
    protected $value;

    /**
     * Add the "og"-prefix?
     *
     * @var bool
     */
    protected $prefixed;

    /**
     * Constructor call.
     * 
     * @param string $name     The name of the tag
     * @param mixed  $value    The value of the tag
     * @param bool   $prefixed Add the "og"-prefix?
     */
    public function __construct(string $name, $value, bool $prefixed = true) 
    {
        $this->setAttribute('name', $name);
        $this->setAttribute('value', $value);
        $this->setAttribute('prefixed', $prefixed);
    }

    /**
     * {@inheritDoc}
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * {@inheritDoc}
     */
    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    /**
     * Sets an object attribute to a value.
     * 
     * @param string $name  The name of the object attribute
     * @param mixed  $value The value of the object attribute
     */
    protected function setAttribute(string $name, $value) : void
    {
        // Convert values
        switch ($name) {
            case 'name':
                // no break here
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
