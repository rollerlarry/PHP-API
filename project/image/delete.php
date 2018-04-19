<?php
	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	 
	// Include database and object file
	include_once '../../config/database.php';
	include_once '../../objects/project.php';
	 
	// Get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$project = new Project($db);
	 
	// $data = json_decode(file_get_contents("php://input"));
	 
	$project->project_id = 26;

	if($project->delete()){
	    echo '{';
	        echo '"message": "Project was deleted."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to delete project."';
	    echo '}';
	}
?>