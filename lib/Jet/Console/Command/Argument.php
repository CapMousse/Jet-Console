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
     * Set the name of the argument
     *
     * @param String $name
     *
     * @return Argument
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name of the argument
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
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
     * Get the type of the argument
     *
     * @return Int
     */
    public function getType()
    {
        return $this->type;
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
     * Get the value of the Argument
     *
     * @return Mixed
     */
    public function getValue()
    {
        return $this->value;
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

    /**
     * Get the description of the Argument
     *
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }
}
