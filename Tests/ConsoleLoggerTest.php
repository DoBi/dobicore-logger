<?php

namespace DoBi\Core\Logger;

use Psr\Log\Test\LoggerInterfaceTest;

/**
 * @outputBuffering disabled
 */
class ConsoleLoggerTest extends LoggerInterfaceTest {
    protected $logger;

    public function getLogger() {
        $this->logger = new ConsoleLogger();
        return $this->logger;
    }

    public function getLogs() {
        return $this->logger->getAllLogs();
    }

    public function testImplementsCore() {
        $this->assertInstanceOf('DoBi\Core\Logger\CoreLogger', $this->getLogger());
    }

    /**
     * @outputBuffering disabled
     */
    public function testConsoleOutput() {
        $expectedOutput = 'info test 123';

        $this->expectOutputString($expectedOutput);

        $logger = $this->getLogger();

        $logger->info('test {numbers}', array('numbers' => 123));
    }
}
