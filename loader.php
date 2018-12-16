<?php
$selfUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$selfUrl = explode('?', $selfUrl)[0];

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

if ($_GET['loader']==='async') {
    if (!isset($_GET['function'])) {
        http_response_code(400);
        header("Content-type: application/json");
        die(json_encode(array(
            'status' => 'error',
            'message' => 'In GET parameters should be function (name of the loader function in window).'
            ), JSON_PRETTY_PRINT
        ));
    }
    header("Content-Type: application/javascript");
    $contents = file_get_contents('loaderAsync.js');
    $contents = str_replace('{URL}', $selfUrl, $contents);
    $contents = str_replace('{FUNCTION}', $selfUrl, $_GET['function']);
    die($contents);
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
        http_response_code(404);
        header("Content-type: application/json");
        die(json_encode(array(
            'status' => 'error',
            'message' => 'Version does not exists'
            ), JSON_PRETTY_PRINT
        ));
    }
} else {
    http_response_code(400);
    header("Content-type: application/json");
    die(json_encode(array(
        'status' => 'error',
        'message' => 'Version should be in the semantic version format.'
        ), JSON_PRETTY_PRINT
    ));
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

        $files = array($files[0]);

        return $files;
    }

    $js = getFiles("versions/$version/**/main*.js");
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
    http_response_code(500);
    header("Content-type: application/json");
    die(json_encode(array(
        'status' => 'error',
        'message' => "Version $version is corrupted on the server."
    ), JSON_PRETTY_PRINT
    ));
}
?>