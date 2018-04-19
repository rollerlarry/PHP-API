<?php 
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/image.php';

    $database = new Database();
    $db = $database->getConnection();

    $image = new image($db);

    $stmt = $image->read();
    $num = $stmt->rowCount();

    if($num>0){
     
        $image_arr=array();
        $image_arr["records"]=array();
     
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
     
            $image_item=array(
                "imageid" => $row['imageID'],
                "imagepath" => $row['imagePath'],
                "datecreated" => $row['DateCreated']
                
            );
     
            array_push($image_arr["records"], $image_item);
        }
     
        echo json_encode($image_arr);
    }else{
        echo json_encode(
            array("==> Notification" => "No image found.")
        );
    }

 ?>