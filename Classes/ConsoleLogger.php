<?php
/**
 * A command line logger
 *
 * @author Dominik Bittner <DoBi-tyndur@gmx.net>
 */

namespace DoBi\Core\Logger;

use Psr\Log\InvalidArgumentException;

/**
 * This logger simply prints the logs to the command line
 */
class ConsoleLogger extends CoreLogger {
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
        print $log;
    }
}
