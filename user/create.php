<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	
	include_once '../config/database.php';
	 
	
	include_once '../objects/user.php';

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);

	// $data = json_decode(file_get_contents("php://inputdata"));

	$user->full_name = "ABC";
	$user->user_name = "abc";
	$user->password = "123";


	if($user->create()){
	    echo '{';
	        echo '"message": "User was created."';
	    echo '}';
	}
	 
	// if unable to create the product, tell the user
	else{
	    echo '{';
	        echo '"message": "Unable to create user."';
	    echo '}';
	}


 ?>