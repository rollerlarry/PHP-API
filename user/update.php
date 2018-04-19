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
	 
	if(isset($_GET['userid']) || isset($_GET['fullname']) || isset($_GET['username']) || isset($_GET['password'])){

		$user_id = $_GET['userid'];
		$full_name = $_GET['fullname'];
		$user_name = $_GET['username'];
		$password = $_GET['password'];
	} 

	$user->user_id = $user_id;
	 

	$user->full_name = $full_name;
	$user->user_name = $user_name;
	$user->password = $password;
	 
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