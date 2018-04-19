<?php 
	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// Include database and object files
	include_once '../config/database.php';
	include_once '../objects/user.php';

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);


	if(isset($_GET['fullname']) || isset($_GET['username']) || isset($_GET['password'])){
		$full_name = $_GET['fullname'];
		$user_name = $_GET['username'];
		$password = $_GET['password'];
	}

	$user->full_name = $full_name;
	$user->user_name = $user_name;
	$user->password = $password;


	if($user->create()){
	    echo '{';
	        echo '"message": "User was created."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to create user."';
	    echo '}';
	}

 ?>