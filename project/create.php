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


	if(isset($_GET['projectname']) || isset($_GET['foldername']) || isset($_GET['currentuser'])){
		$project_name = $_GET['projectname'];
		$folder_name = $_GET['foldername'];
		$current_user = $_GET['currentuser'];
	}

	$project->project_name = $project_name;
	$project->folder_name = $folder_name;


	$project->current_user = $current_user;
	
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