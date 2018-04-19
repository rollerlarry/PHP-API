<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// include database and object files
	include_once '../config/database.php';
	include_once '../objects/project.php';
	 
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$project = new Project($db);
	 
	// $data = json_decode(file_get_contents("php://input"));
	 
	$project->project_id = 15;
	 
	$project->project_name = "ATM Banking";
	$project->folder_name = "atmbanking";
	 
	// update the product
	if($project->update()){
	    echo '{';
	        echo '"message": "Project was updated."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to update project."';
	    echo '}';
	}
?>