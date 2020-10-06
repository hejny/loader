<?php

$selfUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$selfUrl = explode('?', $selfUrl)[0];

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

if (isset($_GET['js'])) {
    header("Content-Type: application/javascript");
    $contents = file_get_contents('loader.template.js');
    $contents = str_replace('{URL}', $selfUrl, $contents);
    echo $contents;
    exit();
}

define('BASE_URL', explode('loader.php', $selfUrl)[0]);

if (preg_match('/^(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)$/', $_GET['version'])) {
    $version = $_GET['version'];
    $versions = glob("versions/$version"); //todo secure?
    usort($versions, function ($version1, $version2) {
        return -version_compare(basename($version1), basename($version2));
    });

    if (count($versions) !== 0) {
        $version = basename($versions[0]);
    } else {
        //todo REST JSON + 404
        die('version not exists');
    }
} else {
    //todo REST JSON + 400
    die('?version=[semantic version]');
}

if (file_exists("versions/$version")) {
    //todo not found

    function getFiles($globPattern)
    {
        $files = glob($globPattern);

        usort($files, function ($a, $b) {
            return filemtime($a) < filemtime($b);
        });

        foreach ($files as &$url) {
            $url = BASE_URL . $url;
        }

        return $files;
    }

    $js = getFiles("versions/$version/**/*.js");
    $css = getFiles("versions/$version/**/*.css");

    $response = array(
        'status' => 'ok',
        'data' => array(
            'version' => $version,
            'assets' => array(
                'js' => $js,
                'css' => $css
            )
        )
    );

    header("Content-type: application/json");
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    //todo REST JSON + 404
    die('unexpected error');
}
?>