<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// include database and object files
	include_once '../config/database.php';
	include_once '../objects/image.php';
	 
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$image = new image($db);
	 
	// $data = json_decode(file_get_contents("php://input"));
	 
	$image->image_id = 23;
	 

	
	 
	if($image->update()){
	    echo '{';
	        echo '"message": "Image was updated."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to update image."';
	    echo '}';
	}
?>