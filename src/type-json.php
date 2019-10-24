<?php

$js = getFiles(VERSION, 'js');
$css = getFiles(VERSION, 'css');

$response = array(
    'version' => $version,
    'assets' => array(
        'js' => $js,
        'css' => $css
    )
);

header('Content-type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

?>
