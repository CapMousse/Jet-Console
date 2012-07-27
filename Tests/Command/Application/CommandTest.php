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
        require_once(self::$fixturesDir.'EmptyCommand.php');
    }

    public function testInit()
    {
        $this->expectOutputString('init');

        new \Tests\Fixtures\EmptyCommand();
    }

    public function testSetName()
    {
        $command = new \Tests\Fixtures\EmptyCommand();

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
        $command = new \Tests\Fixtures\EmptyCommand();
        $console = new Console();

        $command->setConsole($console);

        $this->assertEquals($console, $command->console);
    }

    public function testAddArgument()
    {
        $command = new \Tests\Fixtures\EmptyCommand();
        $command->addArgument('test', \Jet\Console\Command\Argument::OPTIONAL, 1, 'test');

        $argument = new \Jet\Console\Command\Argument();
        $argument
            ->setName('test')
            ->setType(\Jet\Console\Command\Argument::OPTIONAL)
            ->setValue(1)
            ->setDescription('test');

        $this->assertEquals($argument, $command->arguments[0]);
    }

    public function testExecute()
    {
        $command = new \Tests\Fixtures\EmptyCommand();

        $this->assertTrue($command->execute());
    }

    public function testDisplay()
    {
        $command = new \Tests\Fixtures\EmptyCommand();

        ob_clean();

        $command->testDisplay();

        $this->expectOutputString("test\n");
    }

    public function testHasArgument()
    {
        $console = new Console();
        $command = new \Tests\Fixtures\TestCommand();

        $console->parseCommand(array('testCommand', '--argument1', 'test'));
        $command->setConsole($console);

        $this->assertTrue($command->hasArgument('argument1'));
        $this->assertFalse($command->hasArgument('argument2'));
    }

    public function testGetArgument()
    {
        $console = new Console();
        $command = new \Tests\Fixtures\TestCommand();

        $console->parseCommand(array('testCommand', '--argument1', 'test'));
        $command->setConsole($console);

        $this->assertEquals('test', $command->getArgument('argument1'));

        try {
            $command->getArgument('unknown');
            $this->fail();
        } catch (\Exception $exception) {
            $this->assertInstanceOf('\Jet\Console\Exception\CommandException', $exception);
        }
    }

    public function testHasValue()
    {
        $console = new Console();
        $command = new \Tests\Fixtures\EmptyCommand();

        $console->parseCommand(array('empty', 'value'));
        $command->setConsole($console);

        $this->assertTrue($command->hasValues());


        $console = new Console();
        $command = new \Tests\Fixtures\EmptyCommand();

        $console->parseCommand(array('empty'));
        $command->setConsole($console);

        $this->assertFalse($command->hasValues());
    }

    public function testGetValue()
    {
        $console = new Console();
        $command = new \Tests\Fixtures\EmptyCommand();

        $console->parseCommand(array('empty', 'some', 'test', 'value', 1));
        $command->setConsole($console);

        $this->assertEquals(array('some', 'test', 'value', 1), $command->getValues());

    }
}
