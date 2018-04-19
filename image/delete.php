<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once '../config/database.php';
	include_once '../objects/image.php';
	
	$database = new Database();
	$db = $database->getConnection();
	 
	$image = new Image($db);
	
	$image->image_id = 1;
	
	if($image->delete()){
	    echo '{';
	        echo '"message": "Image was deleted."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to delete image."';
	    echo '}';
	}
?>