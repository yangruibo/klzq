<?php
$url = 'http://apiv2.higaoyao.com:9527/api/v1/home/syncTime';
$header = array('Authorization:Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJkZXYiLCJpYXQiOjE1ODA0MTAyNzYsImV4cCI6MTU4MzAwMjI3NiwibmJmIjoxNTgwNDEwMjc2LCJ1aWQiOjU3ODcxOTd9.SmMzCXQ-VIMZvYTHLIF-J80r1S-piMzLHAiqyyNhlp8','Content-Type:application/json');
$content = [];
for($i=0;$i<60;$i++){
    sleep(1);
    $response = tocurl($url, $header, $content);
    echo $response;
}
exit;
function tocurl($url, $header, $content){
    $ch = curl_init();
    if(substr($url,0,5)=='https'){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($content));
    $response = curl_exec($ch);
    if($error=curl_error($ch)){
        die($error);
    }
    curl_close($ch);
    return $response;
}
