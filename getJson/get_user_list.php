<?php
	$json = file_get_contents('http://localhost/user/read.php');

	$data = json_decode($json);
	foreach ($data->records as $v) {
		echo "----------------------------</br>";
		echo "Fullname : ".$v->userid."</br>";		
		echo "Fullname : ".$v->fullname."</br>";
		echo "Password : ".$v->password."</br>";
	}	
?>