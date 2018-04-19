<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// include database and object files
	include_once '../config/database.php';
	include_once '../objects/user.php';
	 
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$user = new User($db);
	 
	// $data = json_decode(file_get_contents("php://input"));
	 
	$user->user_id = 23;
	 

	$user->full_name = "Alex Nguyen";
	$user->user_name = "alexnguyen";
	$user->password = "111";
	 
	if($user->update()){
	    echo '{';
	        echo '"message": "User was updated."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to update user."';
	    echo '}';
	}
?>