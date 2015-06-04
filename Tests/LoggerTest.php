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
