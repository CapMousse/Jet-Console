<?php

namespace Tests\Fixtures;

use Jet\Console\Command\AbstractCommand;

class EmptyCommand extends AbstractCommand
{
    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    public function init()
    {
        echo 'init';

        $this->setName('empty');
    }

    /**
     * Execute the command
     *
     * @return mixed
     */
    public function execute()
    {
        return true;
    }

    /**
     * Try the Display method
     */
    public function testDisplay()
    {
        $this->display('test');
    }
}
