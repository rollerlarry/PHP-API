<?php 
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/project.php';

    $database = new Database();
    $db = $database->getConnection();

    $project = new Project($db);

    $stmt = $project->read();
    $num = $stmt->rowCount();
    
    if($num>0){
     
        $project_arr=array();
        $project_arr["records"]=array();
     
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
     
            $project_item=array(
                "projectid" => $row['projectID'],
                "projectname" => $row['projectName'],
                "foldername" => $row['folderName']
                
            );
     
            array_push($project_arr["records"], $project_item);
        }
     
        echo json_encode($project_arr);
    }else{
        echo json_encode(
            array("==> Notification" => "No project found.")
        );
    }

 ?>