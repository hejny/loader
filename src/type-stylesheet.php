<?php

header('Content-Type: text/css');

$files = getFiles(VERSION, 'css');

foreach ($files as $file) {
    echo '@import url("' . $file . '");' . "\n";
}

?>
