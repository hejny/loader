<?php

if (!isset($_GET['function'])) {
    error(400, 'When using type=script in GET params should be function.');
}

header('Content-Type: application/javascript');
$contents = file_get_contents(__DIR__ . '/loaderAsync.js');
//$contents = str_replace('{URL}', SELF_URL, $contents);
//$contents = str_replace('{FUNCTION}', $_GET['function'], $contents);
die($contents);
