<?php

$response = array(
    'version' => $version,
    'assets' => array(
        'js' => getFiles(VERSION, 'js'),
        'css' => getFiles(VERSION, 'css')
    )
);

header('Content-type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

?>
