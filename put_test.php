<?php

$service_url = 'localhost/online_store/api.php/products/';
$service_url.= $id;

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
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

$data = array();
if(isset($name))
	$data["Name"] = $name;
if(isset($category))
	$data["Category"] = $category;
if(isset($quantity))
	$data["Quantity"] = $quantity;
curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($data));

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