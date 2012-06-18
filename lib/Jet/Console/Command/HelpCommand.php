<?php

namespace Jet\Console\Command;

class HelpCommand extends AbstractCommand
{
    /**
     * Add command with name, argument and description
     *
     * @return void
     */
    public function init()
    {
        $this
            ->setName('help')
            ->addArgument('command', array($this, 'commandHelp'), Argument::OPTIONAL, null, 'Details about the input command');
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

    /**
     * Show a specific command infos
     *
     * @param String $command
     *
     * @return bool
     */
    public function commandHelp($command)
    {
        if (null === $command) {
            $this->display("Missing command name to detail");
            return false;
        }

        return true;
    }
}
