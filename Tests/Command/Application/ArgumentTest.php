<?php

namespace Jet\Console\Tests;

use Jet\Console\Command\Argument;

class ArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Argument
     */
    public static $argument;

    public static function setUpBeforeClass()
    {
        self::$argument = new Argument();
    }

    public function testSetName()
    {
        $this->assertInstanceOf('\Jet\Console\Command\Argument', self::$argument->setName('test'));
    }

    public function testGetName()
    {
        self::$argument->setName('test');
        $this->assertEquals('test', self::$argument->getName());
    }

    public function testSetType()
    {
        $this->assertInstanceOf('\Jet\Console\Command\Argument', self::$argument->setType(Argument::REQUIRED));

        try{
            self::$argument->setType('test');
            $this->fail('Argument::setType don\'t throw exception on invalid argument type');
        }catch (\Exception $e) {
            $this->assertInstanceOf('\InvalidArgumentException', $e);
        }
    }

    public function testGetType()
    {
        self::$argument->setType(Argument::REQUIRED);
        $this->assertInstanceOf('\Jet\Console\Command\Argument', self::$argument->setName('test'));
    }

    public function testSetValue()
    {
        $this->assertInstanceOf('\Jet\Console\Command\Argument', self::$argument->setValue('test'));
    }

    public function testGetValue()
    {
        self::$argument->setValue('test');
        $this->assertEquals('test', self::$argument->getValue());
    }

    public function testSetDescription()
    {
        $this->assertInstanceOf('\Jet\Console\Command\Argument', self::$argument->setDescription('test'));
    }

    public function testGetDescription()
    {
        self::$argument->setDescription('test');
        $this->assertEquals('test', self::$argument->getDescription());
    }
}
