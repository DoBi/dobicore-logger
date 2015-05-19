<?php

namespace DoBi\Core\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase {
    protected $logger;

    public function setUp() {
        $this->logger = new Logger();
    }

    public function testInterfaces() {
        $this->assertInstanceOf('Psr\Log\LoggerInterface', $this->logger);
        $this->assertInstanceOf('Psr\Log\LoggerAwareInterface', $this->logger);
    }

    public function testConstructor() {
        $this->logger = new Logger(new ConsoleLogger());
    }

    public function testEmptyLog() {
        $this->logger->error('test', array());
    }

    public function testConsoleOutput() {
        $expectedOutput = 'info test 123';

        $this->expectOutputString($expectedOutput);

        $this->logger->setLogger(new ConsoleLogger());

        $this->logger->info('test {numbers}', array('numbers' => 123));
    }
}
