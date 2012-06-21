<?php

namespace Jet\Console\Command;

use Jet\Console\Console;
use Jet\Console\Exception\CommandException;

abstract class AbstractCommand
{
    /**
     * Name of the command
     * @var string
     */
    public $name = "";

    /**
     * Description of the command
     * @var string
     */
    public $description = "";

    /**
     * Arguments of the command
     * @var Argument[]
     */
    public $arguments = array();

    /**
     * The application using the command
     * @var Console
     */
    public $console = null;

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
     * Set the description of the command
     *
     * @param String $description
     *
     * @return AbstractCommand
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the description of the command
     *
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the application using the command
     *
     * @param Console $app the application
     *
     * @return AbstractCommand
     */
    public function setConsole(Console $app)
    {
        $this->console = $app;

        return $this;
    }

    /**
     * Add an argument to the current command
     *
     * @param String      $name        the argument name
     * @param int         $type        Argument::REQUIRED or Argument::OPTIONAL
     * @param Mixed       $value       the default value of the argument
     * @param String|Null $description the description of the argument
     *
     * @throws \InvalidArgumentException
     * @return AbstractCommand
     */
    protected function addArgument($name, $type = Argument::OPTIONAL, $value = null, $description = null)
    {
        $class = __CLASS__;

        if (empty($name)) {
            throw new \InvalidArgumentException("Command {$class} : Argument name can't be empty");
        }

        if (!is_int($type)) {
            throw new \InvalidArgumentException("Argument {$name} : Type must be Argument::REQUIRED or Argument::OPTIONAL");
        }

        $argument = new Argument();
        $argument
            ->setName($name)
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
    public function hasArgument($name)
    {
        return isset($this->console->commandArguments[$name]);
    }

    /**
     * Get the content of an argument
     *
     * @param String $name argument name
     *
     * @return \Jet\Console\Command\Argument
     * @throws \Jet\Console\Exception\CommandException
     */
    public function getArgument($name)
    {
        if (!$this->hasArgument($name)) {
            throw new CommandException("Argument {$name} don't exists");
        }

        return $this->console->commandArguments[$name];
    }

    /**
     * Check if a command has values
     *
     * @return bool
     */
    public function hasValues()
    {
        return count($this->console->commandValues) > 0;
    }

    /**
     * Get the command values
     *
     * @return array
     */
    public function getValues()
    {
        return $this->console->commandValues;
    }
}
