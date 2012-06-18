<?php

namespace Jet\Console\Command;

use Jet\Console\Console;

abstract class AbstractCommand
{
    /**
     * Name of the command
     * @var string
     */
    protected $name = "";

    /**
     * Arguments of the command
     * @var array
     */
    protected $arguments = array();

    /**
     * The application using the command
     * @var Console
     */
    protected $application = null;

    /**
     * Init a new command on the console object
     *
     * @return AbstractCommand
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Set the name of the command
     *
     * @param String $name name of the command
     *
     * @throws \InvalidArgumentException
     * @return AbstractCommand
     */
    protected function setName($name)
    {
        if (true === empty($name)) {
            throw new \InvalidArgumentException("Command name can't be empty");
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get the name of the command
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the application using the command
     *
     * @param Console $app the application
     *
     * @return AbstractCommand
     */
    public function setApplication(Console $app)
    {
        $this->application = $app;

        return $this;
    }

    /**
     * Add an argument to the current command
     *
     * @param String      $name        the argument name
     * @param Array       $method      method to run wen argument detected
     * @param int         $type        Argument::REQUIRED or Argument::OPTIONAL
     * @param Mixed       $value       the default value of the argument
     * @param String|Null $description the description of the argument
     *
     * @throws \InvalidArgumentException
     * @return AbstractCommand
     */
    protected function addArgument($name, $method, $type = Argument::OPTIONAL, $value = null, $description = null)
    {
        $class = __CLASS__;

        if (empty($name)) {
            throw new \InvalidArgumentException("Command {$class} : Argument name can't be empty");
        }

        if (empty($method)) {
            throw new \InvalidArgumentException("Argument {$name} : Argument method can't be empty");
        }

        if (!is_int($type)) {
            throw new \InvalidArgumentException("Argument {$name} : Type must be Argument::REQUIRED or Argument::OPTIONAL");
        }

        $argument = new Argument($name, $method);
        $argument
            ->setType($type)
            ->setValue($value)
            ->setDescription($description);

        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    abstract public function init();

    /**
     * Execute the command
     *
     * @return mixed
     */
    abstract public function execute();

    /**
     * Display a string on console
     *
     * @param $string
     */
    public function display($string)
    {
        echo $string."\n";
    }

    /**
     * Check if the asked argument exists on the user input
     *
     * @param $name
     *
     * @return boolean
     */
    public function hasArgument($name){

    }
}
