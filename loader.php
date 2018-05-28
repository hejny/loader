<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

define('BASE_URL','https://cdn.h-edu.cz/book-viewer-embeded-test/');

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

 
    $js = glob("versions/$version/**/*.js");
    $css = glob("versions/$version/**/*.css");

    foreach($js as &$url){
	$url=BASE_URL.$url;
    }
    foreach($css as &$url){
	$url=BASE_URL.$url;
    }


    $response = array(
        'status' => 'ok',
        'data' =>
            array(
                'version' => $version,
                'assets' => array(
                    //todo maybe relative url
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
