<?php

namespace DoBi\Core\Logger;

use Psr\Log\InvalidArgumentException;

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
