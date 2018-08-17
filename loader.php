<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

$selfUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
define('BASE_URL',explode('loader.php',$selfUrl)[0]);

if (preg_match('/^(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)$/', $_GET['version'])) {
	$version = $_GET['version'];
	$versions = glob("versions/$version");//todo secure?
	usort($versions, function($version1,$version2){
		return(-version_compare(basename($version1),basename($version2)));
	});

	if(count($versions)!==0){
		$version = basename($versions[0]);
	}else{
	    //todo REST JSON + 404
	    die('version not exists');
	}
    
} else {
    //todo REST JSON + 400
    die('?version=[semantic version]');
}



if (file_exists("versions/$version")) {
//todo not found


    function getFiles($globPattern){

        $files = glob($globPattern);

        usort($files, function($a, $b) {
            return filemtime($a) < filemtime($b);
        });

        foreach($files as &$url){
        $url=BASE_URL.$url;
        }

        $files = array($files[0]);

        return $files;
    }


    $js = getFiles("versions/$version/**/*.js");
    $css = getFiles("versions/$version/**/*.css");


    $response = array(
        'status' => 'ok',
        'data' =>
            array(
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
