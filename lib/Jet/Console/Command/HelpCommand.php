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
            ->setDescription('Display the list of available commands. Use "help command" to get help for a specific command');
    }

    /**
     * Execute the command
     *
     * @return mixed
     */
    public function execute()
    {
        if ($this->hasValues()) {
            $command = array_pop($this->getValues());

            $this->commandHelp($command);
        } else {
            $this->parseCommandList();
        }

        return true;
    }

    /**
     * Parse the list of available commands and display them with description
     * @return bool
     */
    public function parseCommandList()
    {
        $appList = $this->console->commands;

        $message = "List of available commands :\n";

        foreach ($appList as $app) {
            $message .= "\t- ".$app->getName();
            $description = $app->getDescription();

            if (!empty($description)) {
                $message .= " : ".$app->getDescription();
            }

            $message .= "\n";
        }

        $this->display($message);

        return true;
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

        if (!isset($this->console->commands[$command])) {
            $this->display("Command {$command} don't exists");
            return false;
        }

        $command = $this->console->commands[$command];
        $message = $command->getName();

        if ($command->getDescription() != "") {
            $message .= " : ".$command->getDescription();
        }

        $message .= "\n";

        foreach ($command->arguments as $argument) {
            $message .= "  --".$argument->getName();

            if ($argument->getDescription() != "") {
                $message .= " : ".$argument->getDescription();
            }

            $message .= "\n";
        }

        $this->display($message);

        return true;
    }
}
