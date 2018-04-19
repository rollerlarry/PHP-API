<?php
	$json = file_get_contents('http://localhost/ProjectPHP-API/project/read.php');

	$data = json_decode($json);
	foreach ($data->records as $v) {
		echo "----------------------------</br>";
		echo "ProjectID : ".$v->projectid."</br>";		
		echo "ProjectName : ".$v->projectname."</br>";
		echo "FolderName : ".$v->foldername."</br>";
	}	
?>