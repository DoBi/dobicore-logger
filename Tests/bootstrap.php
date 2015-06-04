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

require __DIR__ . '/../vendor/autoload.php';

define('TMP', __DIR__ . '/tmp/');
define('TMP_READ_ONLY', __DIR__ . '/tmp/readonly/');

function deleteDir($dir) {
    $files = array_diff(scandir($dir), array('.','..'));

    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}

if (is_dir(TMP)) {
    deleteDir(TMP);
}

mkdir (TMP);
mkdir (TMP_READ_ONLY, 0400);
