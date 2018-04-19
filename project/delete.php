<?php
	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	 
	// Include database and object file
	include_once '../config/database.php';
	include_once '../objects/project.php';
	 
	// Get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$project = new Project($db);
	 
	if(isset($_GET['projectid'])){
		$project_id = $_GET['projectid'];
	} 
	$project->project_id = $project_id;

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