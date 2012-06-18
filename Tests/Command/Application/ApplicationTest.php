<?php

namespace Jet\Console\Tests;

use Jet\Console\Console;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
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
}
