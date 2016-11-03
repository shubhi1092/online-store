<?php
$service_url = 'localhost/online_store/api.php/products/';
if(isset($id))
	$service_url.=$id;
$curl = curl_init($service_url);
curl_setopt(
    $curl, 
    CURLOPT_HTTPHEADER,
    array(
        'X-Access-Token: '.$token,
        'Content-Type: application/json'
    )
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_HEADER, true);

$curl_response = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpcode == '404') {
	echo $curl_response;
    curl_close($curl);
	die();
}

curl_close($curl);
echo $curl_response;
?>