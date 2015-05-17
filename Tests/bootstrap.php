<?php

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
