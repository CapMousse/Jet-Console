<?php

namespace Jet\Console\Tests;

use Jet\Console\Console;

class ConsoleTest extends \PHPUnit_Framework_TestCase
{
    public static $fixturesDir;

    public static function setUpBeforeClass()
    {
        self::$fixturesDir = __DIR__."/../../Fixtures/";
        require_once(self::$fixturesDir.'TestCommand.php');
    }

    public function testConstructor()
    {
        $app = new Console('foo', 'bar');

        $this->assertEquals('foo', $app->getName(), "Console constructor don't get the first argument as name");
        $this->assertEquals('bar', $app->getVersion(), "Console constructor don't get the second argument as version");
        $this->assertEquals(array('help'), $app->getCommandList(), "Command list don't contain the default help command");
    }

    public function testSetGetName()
    {
        $app = new Console();

        $app->setName('foo');
        $this->assertEquals('foo', $app->getName(), 'Console::setName|getName not working');
    }

    public function testSetGetVersion()
    {
        $app = new Console();

        $app->setVersion('bar');
        $this->assertEquals('bar', $app->getVersion(), 'Console::setVersion|getVersion not working');
    }

    public function testAddCommands()
    {
        $app = new Console();

        try{
            $app->addCommands('string');
            $this->fail('Console::addCommands authorize non array input');
        } catch (\Exception $e) {
            $this->assertInstanceOf('\InvalidArgumentException', $e, "Console::addCommands don't throw InvalidArgumentException");
        }

        $this->assertEquals(true, $app->addCommands(array()), "Console::addCommands return false");
        $this->assertEquals(true, $app->addCommands(array(new \Tests\Fixtures\TestCommand())), "Console::addCommands return false");

        try {
            $app->addCommands(array(new Console()));
        } catch (\Exception $e) {
            $this->isTrue();
        }
    }

    public function testAddCommand()
    {
        $app = new Console();

        try{
            $app->addCommand('string');
            $this->fail('Console::addCommand authorize non AbstractCommand element');
        } catch (\Exception $e) {
            $this->isTrue();
        }

        $this->assertInstanceOf('\Jet\Console\Command\AbstractCommand', $app->addCommand(new \Tests\Fixtures\TestCommand()), "Console::addCommands don't return command");
    }
}
