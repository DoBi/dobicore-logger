<?php
/**
 * A simple logger wrapper for all types of loggers
 *
 * @author Dominik Bittner
 */

namespace DoBi\Core\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * A simple logger wrapper for all types of LoggerInterfaces
 */
class Logger extends AbstractLogger implements LoggerAwareInterface {
    /**
     * An array with all assigned loggers
     *
     * @var array
     */
    protected $logger = array();

    /**
     * Creates a new Logger with the given logger type
     *
     * @param LoggerInterface $logger The first logger
     */
    public function __construct(LoggerInterface $logger = null) {
        if ($logger !== null) {
            $this->logger[] = $logger;
        }
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger A new logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger) {
        if ($logger !== null) {
            $this->logger[] = $logger;
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
        foreach ($this->logger as $log) {
            $log->log($level, $message, $context);
        }
    }
}
