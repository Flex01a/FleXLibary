<?php
error_reporting(0);
header('Content-Type: application/json');
// @RRLRR, @hamoudi
// use: https://domain.com/@hamoudi.php?song=https://soundcloud.com/kevingates/really-really
$song = $_GET['song'];

$curl = curl_init();
$config = array(
    CURLOPT_URL            => "https://sctomp3.net/download-track/",
    CURLOPT_HTTPHEADER     => array(
        'origin: https://sctomp3.net',
        'referer: https://sctomp3.net/',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36'
    ),
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => array(
        'url' => $song,
    )
);
curl_setopt_array($curl, $config);
$response   = curl_exec($curl);
curl_close($curl);

$dom        = new DOMDocument();
@$dom->loadHTML($response);
$path       = new DOMXPath($dom);
$results    = $path->query("//*[@class='btn btn-primary']");
for($i=0;$i<$results->length;$i++){
    $result = array('ok'=> true, 'result'=>['url'=> $results->item($i)->getAttribute("href")]);
}
$response = array('ok'=> false, 'descrption'=> 'Missing a vaild url');
if( $song ) {
    if(strpos($song, 'soundcloud.com') !== false ) {
        if($result) {
            $response = $result;
        }
    }
    else
    {
        $response = array('ok'=> false, 'descrption'=> 'invaild soundcloud url');
    }
}
$response['source'] = 'https://t.me/hamoudi';
echo json_encode($response, JSON_PRETTY_PRINT);
