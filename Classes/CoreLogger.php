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

use Psr\Log\AbstractLogger;

/**
 * This class implements basic functions for all loggers
 */
abstract class CoreLogger extends AbstractLogger {
    /**
     * An array with all logs
     * @var array
     */
    protected $logs;

    /**
     * Returns all logs as an array
     * @return array
     */
    public function getAllLogs() {
        return $this->logs;
    }

    /**
     * Interpolates context values into the message placeholders.
     *
     * @param string $message The message string with placeholders
     * @param array  $context An array with the placeholder replacements
     *
     * @return string The log message
     */
    protected function interpolate($message, $context = array()) {
        $replace = array();

        foreach ($context as $key => $value) {
            $key = '{' . $key . '}';

            if (is_object($value) && method_exists($value, '__toString')) {
                $replace[$key] = (string) $value;
            } else if (is_object($value) || is_array($value)) {
                $replace[$key] = print_r($value, true);
            } else {
                $replace[$key] = $value;
            }
        }

        return strtr($message, $replace);
    }
}
