<?php

namespace DoBi\Core\Logger;

use Psr\Log\Test\LoggerInterfaceTest;

class FileLoggerTest extends LoggerInterfaceTest {
    protected $file;
    protected $logger;

    public function getLogger() {
        $this->file = tempnam(TMP, 'filelogger');
        $this->logger = new FileLogger($this->file);
        return $this->logger;
    }

    public function getLogs() {
        return $this->logger->getAllLogs();
    }

    public function testImplementsCore() {
        $this->assertInstanceOf('DoBi\Core\Logger\CoreLogger', $this->getLogger());
    }

    public function testFileOutput() {
        $expectedOutput = 'info test 123';

        $this->getLogger()->info('test {numbers}', array('numbers' => 123));

        $content = file_get_contents($this->file);

        $this->assertSame($expectedOutput, substr($content, 0, strrpos($content, PHP_EOL)));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorException() {
        $this->file = TMP_READ_ONLY . '/fileLogger.log';
        $this->logger = new FileLogger($this->file);
    }
}
