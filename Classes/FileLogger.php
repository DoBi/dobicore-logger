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

use Psr\Log\InvalidArgumentException;

/**
 * This logger simply prints the logs to a file
 */
class FileLogger extends CoreLogger {
    /**
     * The logfiles filehandle
     * @var resource
     */
    protected $fileHandle;

    /**
     * Creates a new FileLogger and opens the log file
     *
     * @param string $file The path to the logfile
     */
    public function __construct($file) {
        if (!is_writable(substr($file, 0, strrpos($file, '/')))) {
            throw new \InvalidArgumentException('Could not open the file ' . $file);
        }

        $this->fileHandle = fopen($file, 'a');
    }

    /**
     * Closes the log file
     */
    public function __destruct() {
        if (is_resource($this->fileHandle)) {
            fclose($this->fileHandle);
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array()) {
        if (!defined('\Psr\Log\LogLevel::' . strtoupper($level))) {
            throw new InvalidArgumentException();
        }

        $log = $level . ' ' . $this->interpolate($message, $context);

        $this->logs[] = $log;
        fwrite($this->fileHandle, $log . PHP_EOL);
    }
}
