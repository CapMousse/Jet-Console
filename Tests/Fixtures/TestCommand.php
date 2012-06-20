<?php

namespace Tests\Fixtures;

use Jet\Console\Command\AbstractCommand;
use Jet\Console\Command\Argument;

class TestCommand extends AbstractCommand
{
    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    public function init()
    {
        $this->setName('testCommand');

        $this->addArgument('argument1', Argument::REQUIRED, null, "A required test argument for the test command");
        $this->addArgument('argument2', Argument::OPTIONAL, null, "A optional test argument for the test command");
    }

    /**
     * Execute the command
     *
     * @return mixed
     */
    public function execute()
    {
        $this->display('this is a test command');

        $argument1 = $this->getArgument('argument1');

        $this->display("Argument1 value is {$argument1}");

        if($this->hasArgument('argument2')){
            $argument2 = $this->getArgument('argument2');
            $this->display("Argument2 defined and value is {$argument2}");
        }
    }
}
