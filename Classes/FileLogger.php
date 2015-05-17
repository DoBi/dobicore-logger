<?php
/**
 * A file logger
 *
 * @author Dominik Bittner <DoBi-tyndur@gmx.net>
 */

namespace DoBi\Core\Logger;

use Psr\Log\InvalidArgumentException;

/**
 * This logger simply prints the logs to a file
 */
class FileLogger extends CoreLogger {
    protected $fileHandle;

    /**
     * Creates a new FileLogger and opens the log file
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
