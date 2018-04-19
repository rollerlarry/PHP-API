<?php
	$json = file_get_contents('http://localhost/image/read.php');

	$data = json_decode($json);
	foreach ($data->records as $v) {
		echo "----------------------------</br>";
		echo "ImageID : ".$v->imageid."</br>";		
		echo "ImagePath : ".$v->imagepath."</br>";
		echo "DateCreated : ".$v->datecreated."</br>";
	}	
?>