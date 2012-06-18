<?php

namespace Jet\Console;

use Jet\Console\Command\AbstractCommand;
use Jet\Console\Command\HelpCommand;

class Console
{
    public $name;
    public $version;
    public $commands = array();

    public $commandName = "";
    public $commandArguments = array();
    public $commandValues = array();

    /**
     * Create a new application
     *
     * @param null $name
     * @param null $version
     *
     * @return Console
     */
    public function __construct($name = null, $version = null)
    {
        $this->name     = $name;
        $this->version  = $version;

        $this->setDefaultCommands();
    }

    /**
     * Add a list of commands to the current application
     *
     * @param Array $commands command to add
     *
     * @throws \InvalidArgumentException
     * @return Boolean
     */
    public function addCommands($commands)
    {
        if (!is_array($commands)) {
            throw new \InvalidArgumentException("Commands must be an array");
        }

        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return true;
    }

    /**
     * Add a command to the application
     *
     * If the command already exists, it will be overwritten
     *
     * @param AbstractCommand $command
     *
     * @return AbstractCommand
     */
    public function addCommand(AbstractCommand $command)
    {
        $this->commands[$command->getName()] = $command;

        $command->setApplication($this);

        return $command;
    }

    /**
     * Set the default commands list
     *
     * @return void
     */
    public function setDefaultCommands()
    {
        $this->addCommands(
            array(
                new HelpCommand()
            )
        );
    }

    /**
     * Get the list of available commands
     *
     * @return array
     */
    public function getCommandList()
    {
        return array_keys($this->commands);
    }

    /**
     * Set the name of the application
     *
     * @param String $name name of the application
     *
     * @throws \InvalidArgumentException
     * @return Boolean
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException("Name can't be empty");
        }

        $this->name = $name;

        return true;
    }

    /**
     * Get the name of application
     *
     * @return String|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the version of the application
     *
     * @param $version
     *
     * @throws \InvalidArgumentException
     * @return Boolean
     */
    public function setVersion($version)
    {
        if (empty($version)) {
            throw new \InvalidArgumentException("Version can't be empty");
        }

        $this->version = $version;

        return true;
    }

    /**
     * Get the version of application
     *
     * @return String|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Launch the Console
     *
     * @param Array $command command to launch
     *
     * @return Boolean
     */
    public function run($command = null)
    {
        $this->parseCommand($command);

        if (empty($this->commandName)) {
            $this->commandName = "help";
        }

        if (isset($this->commands[$this->commandName])) {
            $this->commands[$this->commandName]->execute();
        }
    }

    /**
     * Parse string from the console
     *
     * @param Array|Null $command an inline command to run [optional]
     *
     * @return Boolean
     */
    private function parseCommand($command = null)
    {
        $argv = $command === null ? $_SERVER['argv'] : $command;

        if(count($argv) == 0){
            return false;
        }

        //don't need the bin name
        array_shift($argv);
        $this->commandName = array_shift($argv);

        foreach($argv as $i => $arg){
            if(strstr($arg, '--')){
                $name = substr($arg, 2);
                $value = true; //default value

                //if a value is set to the argument, get and delete it
                if(isset($argv[$i+1])){
                    $value = $argv[$i+1];
                    unset($argv[$i+1]);
                }

                $this->commandArguments[$name] = $value;
            }else{
                $this->commandValues[] = $arg;
            }
        }

        return true;
    }
}
