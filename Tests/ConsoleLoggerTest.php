<?php
/**
 * This file is part of dobicore-logger
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 *
 * @copyright 2015 Dominik Bittner<DoBi-tyndur@gmx.net>
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 * @author    Dominik Bittner
 */

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

    public function testConsoleOutput() {
        $expectedOutput = 'info test 123';

        $this->expectOutputString($expectedOutput);

        $logger = $this->getLogger();

        $logger->info('test {numbers}', array('numbers' => 123));
    }
}
