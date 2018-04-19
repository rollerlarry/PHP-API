<?php 
	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// Include database and object files
	include_once '../config/database.php';	
	include_once '../objects/project.php';

	$database = new Database();
	$db = $database->getConnection();

	$project = new Project($db);

	// $data = json_decode(file_get_contents("php://inputdata"));



	$project->project_name = "ATM Banking";
	$project->folder_name = "atmbanking";

	$project->image_name = "123.png";
	$project->date_created ="12/12/1222";

	$project->current_user = "rollerlarry";
	
	if($project->create()){
	    echo '{';
	        echo '"message": "Project was created."';
	    echo '}';
	}
	 
	else{
	    echo '{';
	        echo '"message": "Unable to create project."';
	    echo '}';
	}



 ?>