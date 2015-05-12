<?php

namespace DoBi\Core\Logger;

use Psr\Log\Test\LoggerInterfaceTest;

/**
 * @outputBuffering disabled
 */
class WebConsoleLoggerTest extends LoggerInterfaceTest {
    protected $logger;

    public function getLogger() {
        $this->logger = new WebConsoleLogger();
        return $this->logger;
    }

    public function getLogs() {
        return $this->logger->getAllLogs();
    }

    public function testImplementsCore() {
        $this->assertInstanceOf('DoBi\Core\Logger\CoreLogger', $this->getLogger());
    }

    public function testConsoleOutput() {
        $expectedOutput = '<script type="text/javascript">console.log("info test 123");</script>';

        $this->expectOutputString($expectedOutput);

        $this->getLogger()->info('test {numbers}', array('numbers' => 123));
    }

    public function testQuotedOutput() {
        $expectedOutput = '<script type="text/javascript">console.log("info \"test\" 123");</script>';

        $this->expectOutputString($expectedOutput);

        $this->getLogger()->info('"test" {numbers}', array('numbers' => 123));
    }
}
