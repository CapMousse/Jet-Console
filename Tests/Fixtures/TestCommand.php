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

        $this->addArgument('testArgument', Argument::OPTIONAL, null, "A optional test argument for the test command");
        $this->addArgument('testArgument', Argument::REQUIRED, null, "A required test argument for the test command");
    }

    /**
     * Execute the command
     *
     * @return mixed
     */
    public function execute()
    {
        $this->display('this is a test command');
    }
}
