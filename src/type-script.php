<?php

if (!isset($_GET['function'])) {
    error(400, 'When using type=script in GET params should be function.');
}

header('Content-Type: application/javascript');
$contents = file_get_contents(__DIR__ . '/type-script.js');

// TODO: Some better way how to template javascript file.

$contents = str_replace('__VERSION__', VERSION, $contents);
$contents = str_replace('__ASSETS__', json_encode(getFiles(VERSION, 'js'), JSON_PRETTY_PRINT), $contents);
$contents = str_replace('__FUNCTION__', $_GET['function'], $contents);
$contents = str_replace('__EXPORTS__', isset($_GET['exports']) ? $_GET['exports'] : 'null', $contents);

echo $contents;
