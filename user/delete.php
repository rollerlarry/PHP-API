<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	 
	// include database and object file
	include_once '../config/database.php';
	include_once '../objects/user.php';
	 
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$user = new User($db);
	 
	
	if(isset($_GET['userid'])){
		$user_id = $_GET['userid'];
	}
	$user->user_id = $user_id;
	 
	if($user->delete()){
	    echo '{';
	        echo '"message": "User was deleted."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to delete user."';
	    echo '}';
	}
?>