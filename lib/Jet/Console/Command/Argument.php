<?php

namespace Jet\Console\Command;

class Argument
{
    const REQUIRED = 1;
    const OPTIONAL = 2;

    public $name;
    public $type;
    public $value;
    public $description;

    /**
     * Create a new argument
     *
     * @param String $name   Name of the argument
     * @param String $method Method to execute when argument detected
     *
     * @return Argument
     */
    public function __construct($name, $method)
    {

    }

    /**
     * Set the type of argument
     *
     * @param $type
     *
     * @return Argument
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the default value of the Argument
     *
     * @param Mixed $value
     *
     * @return Argument
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the description of the Argument
     *
     * @param $description
     *
     * @return Argument
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
