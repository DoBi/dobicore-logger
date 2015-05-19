<?php
/**
 * A logger for a web console like firebug
 *
 * @author Dominik Bittner <DoBi-tyndur@gmx.net>
 */

namespace DoBi\Core\Logger;

use Psr\Log\InvalidArgumentException;

/**
 * This logger creates a javascript which could be interpreted by firebug and
 * some other web consoles
 */
class WebConsoleLogger extends CoreLogger {
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
        print '<script type="text/javascript">console.log("' . addslashes($log) . '");</script>';
    }
}