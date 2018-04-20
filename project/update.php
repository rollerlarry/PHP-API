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
	include_once '../objects/image.php';
	 
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	$project = new Project($db);
	
	if(isset($_GET['projectid']) || isset($_GET['projectname']) || isset($_GET['foldername']) || isset($_GET['currentuser'])){
		$project_id = $_GET['projectid'];
		$project_name = $_GET['projectname'];
		$folder_name = $_GET['foldername'];
		$current_user = $_GET['currentuser'];
	}  
	 
	$project->project_id = $project_id;
	 
	$project->project_name = $project_name;
	$project->folder_name = $folder_name;
	$project->current_user = $current_user;


	$image = new Image($db);
	
	$image->current_user = $current_user;
	$image->folder_name = $folder_name;
	 
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