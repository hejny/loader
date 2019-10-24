<?php

define(
    'SELF_URL',
    explode('?', ($_SERVER['HTTPS'] ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")[0]
);

header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

function error($code, $message)
{
    http_response_code($code);
    header('Content-type: application/json');
    die(
        json_encode(
            array(
                'status' => 'error',
                'message' => $message
            ),
            JSON_PRETTY_PRINT
        )
    );
}

if (!preg_match('/^(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)$/', $_GET['version'])) {
    error(400, 'In GET params should be version in the semantic version format.');
}

$version = $_GET['version'];
$versions = glob(__DIR__ . "/../versions/$version"); //TODO: security
usort($versions, function ($version1, $version2) {
    return -version_compare(basename($version1), basename($version2));
});

if (count($versions) !== 0) {
    define('VERSION', basename($versions[0]));
} else {
    error(404, "Version {$_GET['version']} does not exists");
}

if (!file_exists(__DIR__ . '/../versions/' . VERSION)) {
    error(500, 'Version ' . VERSION . ' is corrupted on the server.');
}

function getFiles($version, $ext)
{
    // TODO: Only main*.js files because of react chunks.
    $files = array_merge(
        glob(__DIR__ . "/../versions/$version/*.$ext"),
        glob(__DIR__ . "/../versions/$version/**/*.$ext")
    );

    $files = array_unique($files);

    usort($files, function ($a, $b) {
        return filemtime($a) < filemtime($b);
    });

    foreach ($files as &$url) {
        $url = str_replace(__DIR__ . '/../', SELF_URL, $url);
    }

    return $files;
}

switch ($_GET['type']) {
    case 'json':
        require_once __DIR__ . '/type-json.php';
        break;
    case 'script':
        require_once __DIR__ . '/type-script.php';
        break;
    case 'stylesheet':
        require_once __DIR__ . '/type-stylesheet.php';
        break;
    default:
        error(400, 'In GET params should be type=json, type=script or type=stylesheet.');
}

?>
