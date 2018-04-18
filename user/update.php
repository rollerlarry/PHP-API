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
	 
	// prepare product object
	$user = new User($db);
	 
	// get id of product to be edited
	// $data = json_decode(file_get_contents("php://input"));
	 
	// set ID property of product to be edited
	$user->user_id = 23;
	 
	// set product property values

	$user->full_name = "Alex Nguyen";
	$user->user_name = "alexnguyen";
	$user->password = "111";
	 
	// update the product
	if($user->update()){
	    echo '{';
	        echo '"message": "User was updated."';
	    echo '}';
	}
	 
	// if unable to update the product, tell the user
	else{
	    echo '{';
	        echo '"message": "Unable to update user."';
	    echo '}';
	}
?>