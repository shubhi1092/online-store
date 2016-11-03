<?php
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'GET'){
	if (isset($_GET['action']))
		$action = $_GET['action'];	//action can be view, create, update, delete
	else{
		echo "Please provide action in the url.";
		die();
	}
	if (isset($_GET['token']))
		$token = $_GET['token'];
	else{
		echo "Please provide access token in the url.";
		die();
	}
	if (isset($_GET['id']))
		$id = $_GET['id'];
	if (isset($_GET['name']))
		$name = $_GET['name'];
	if (isset($_GET['category']))
		$category = $_GET['category'];
	if (isset($_GET['quantity']))
		$quantity = $_GET['quantity'];
}

if($action == 'view'){
	require 'get_test.php';
}
elseif($action == 'create'){
	if(!isset($id) || !isset($category) || !isset($name) || !isset($quantity)){
		echo "Please provide id, name, category, and quantity of the product to insert.";
		die();
	}
	require 'post_test.php';
}
elseif($action == 'update'){
	if (!isset($id)){
		echo "Please provide id that has to be updated.";
		die();
	}
	if(!isset($category) && !isset($name) && !isset($quantity)){
		echo "Please provide atleast one of the parameters to update: name, category, or quantity.";
		die();
	}
	require 'put_test.php';
}
elseif($action == 'delete'){
	if (!isset($id)){
		echo "Please provide id that has to be deleted.";
		die();
	}
	require 'del_test.php';
}
else{
	echo "Invalid action. Action should be view/create/update/delete. Please try again.";
}
?>