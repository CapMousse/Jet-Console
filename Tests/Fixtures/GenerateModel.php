<?php

namespace Tests\Fixtures;

use Jet\Console\Command\AbstractCommand;

class GenerateModel extends AbstractCommand
{
    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('generate:model');
    }

    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    public function init()
    {
        // TODO: Implement init() method.
    }

    /**
     * Execute the command
     *
     * @return mixed
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }
}
