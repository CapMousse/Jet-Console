<?php

namespace Jet\Console\Test;

use Jet\Console\Command\AbstractCommand;
use Jet\Console\Console;

class CommandTest Extends \PHPUnit_Framework_TestCase
{
    public static $fixturesDir;

    public static function setUpBeforeClass()
    {
        self::$fixturesDir = __DIR__."/../../Fixtures/";
        require_once(self::$fixturesDir.'TestCommand.php');
    }

    public function testSetName()
    {
        $command = new \Tests\Fixtures\TestCommand();

        try {
            $command->setName('');
            $this->fail('Command can have empty name');
        } catch (\InvalidArgumentException $exception) {
            $this->assertInstanceOf('\InvalidArgumentException', $exception);
        }
    }

    public function testGetName()
    {
        $command = new \Tests\Fixtures\TestCommand();

        $this->assertEquals('testCommand', $command->getName());
    }

    public function testSetDescription()
    {
        $command = new \Tests\Fixtures\TestCommand();

        $this->assertInstanceOf('Jet\Console\Command\AbstractCommand', $command->setDescription('test'));
    }

    public function testGetDescription()
    {
        $command = new \Tests\Fixtures\TestCommand();

        $this->assertEquals('A test command for unit testing', $command->getDescription());
    }

    public function testSetConsole()
    {
        $command = new \Tests\Fixtures\TestCommand();
        $console = new Console();

        $command->setConsole($console);

        $this->assertEquals($console, $command->console);
    }
}
