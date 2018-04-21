<?php 
	class Image{
		private $conn;
		private $table_name = "tbimage";
		private $table_name_project = "tbproject";

		public $current_user;
		public $folder_name;
		public $project_id;

		public function __construct($db){
			$this->conn = $db;
		}

		//Read image
		function read(){
			$query = "SELECT imageID,imagePath,DateCreated
					FROM 
						" . $this->table_name . "";

		    $stmt = $this->conn->prepare($query);
		    $stmt->execute();
		    
		    return $stmt;
		}

		//Create image
		function create(){

			if (isset($_POST['btnUpload']))
			{
			$url = "http://localhost/project/create.php"; // request URL
			$filename = $_FILES['file']['name'];
			$filedata = $_FILES['file']['tmp_name'];
			$filesize = $_FILES['file']['size'];

				if ($filedata != '')
				{
				    $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
				    $postfields = array("filedata" => "@$filedata", "filename" => $filename);
				    $ch = curl_init();
				    $options = array(
				        CURLOPT_URL => $url,
				        CURLOPT_HEADER => true,
				        CURLOPT_POST => 1,
				        CURLOPT_HTTPHEADER => $headers,
				        CURLOPT_POSTFIELDS => $postfields,
				        CURLOPT_INFILESIZE => $filesize,
				        CURLOPT_RETURNTRANSFER => true
				    ); // cURL options
				    curl_setopt_array($ch, $options);
				    curl_exec($ch);
				    if(!curl_errno($ch))
				    {
				        $info = curl_getinfo($ch);
				        if ($info['http_code'] == 200)
				            $errmsg = 1; //"File uploaded successfully"
				    }
				    else
				    {
				        $errmsg = curl_error($ch);
				    }
				    curl_close($ch);
				}
				else
				{
				    $errmsg = 0; //"Please select the file"
				}

				//Insert image path to sql
	    		date_default_timezone_set('Asia/Ho_Chi_Minh');
		        $date_created = date('d-m-Y');
		        $image_path = 'image/'.$this->folder_name.'/'.$date_created.'/'.$this->current_user.'/'.$filename;
				$query = "INSERT INTO
	                    	" . $this->table_name . "
	                	SET
	                    imagePath= '{$image_path}', DateCreated= '{$date_created}'";

	            $stmt = $this->conn->prepare($query);

	            //Create folder
		 	   if (!file_exists('image/'.$this->folder_name)) {
				    mkdir('image/'.$this->folder_name, 0777, true);
					mkdir('image/'.$this->folder_name.'/'.$date_created, 0777, true);
					mkdir('image/'.$this->folder_name.'/'.$date_created.'/'.$this->current_user, 0777, true);
				}

	            //Move image to folder
	            if ($filedata != '' && $filename != ''){
				 	move_uploaded_file($filedata,$image_path);
	            }
			    

			}

            if($stmt->execute()){
            return true;
	        }
	     
	        return false;
		}


		function update(){

			if (isset($_POST['btnUpload']))
			{
			$url = "http://localhost/project/update.php"; // request URL
			$filename = $_FILES['file']['name'];
			$filedata = $_FILES['file']['tmp_name'];
			$filesize = $_FILES['file']['size'];

				if ($filedata != '')
				{
				    $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
				    $postfields = array("filedata" => "@$filedata", "filename" => $filename);
				    $ch = curl_init();
				    $options = array(
				        CURLOPT_URL => $url,
				        CURLOPT_HEADER => true,
				        CURLOPT_POST => 1,
				        CURLOPT_HTTPHEADER => $headers,
				        CURLOPT_POSTFIELDS => $postfields,
				        CURLOPT_INFILESIZE => $filesize,
				        CURLOPT_RETURNTRANSFER => true
				    ); // cURL options
				    curl_setopt_array($ch, $options);
				    curl_exec($ch);
				    if(!curl_errno($ch))
				    {
				        $info = curl_getinfo($ch);
				        if ($info['http_code'] == 200)
				            $errmsg = 1; //"File uploaded successfully"
				    }
				    else
				    {
				        $errmsg = curl_error($ch);
				    }
				    curl_close($ch);
				}
				else
				{
				    $errmsg = 0; //"Please select the file"
				}
				//Select imageID of project to update image for this project
				$query_sl = "SELECT imageID FROM " . $this->table_name_project . " WHERE projectID = " . $this->project_id."";
				$stmt_sl = $this->conn->prepare($query_sl);
				$stmt_sl->execute();
		    	$row = $stmt_sl->fetch(PDO::FETCH_ASSOC);
		    	$image_id = $row['imageID'];


				//Update image path to sql
	    		date_default_timezone_set('Asia/Ho_Chi_Minh');
		        $date_created = date('d-m-Y');
		        $image_path = 'image/'.$this->folder_name.'/'.$date_created.'/'.$this->current_user.'/'.$filename;
				$query = "UPDATE
	                    	" . $this->table_name . "
	                	SET
		                    imagePath= '{$image_path}', 
		                    DateCreated= '{$date_created}'
						WHERE imageID = $image_id";

	            $stmt = $this->conn->prepare($query);

	            //Create folder
			    if (!file_exists('image/'.$this->folder_name)) {
				    mkdir('image/'.$this->folder_name, 0777, true);
					mkdir('image/'.$this->folder_name.'/'.$date_created, 0777, true);
					mkdir('image/'.$this->folder_name.'/'.$date_created.'/'.$this->current_user, 0777, true);
				}

	            //Move image to folder
	            if ($filedata != '' && $filename != ''){
				 	move_uploaded_file($filedata,$image_path);
	            }

			}
			
		
		    if($stmt->execute()){
            return true;
	        }
	     
	        return false;

		}

		//Delete image
		function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE imageID = ?";
	        $stmt = $this->conn->prepare($query);
	        $stmt->bindParam(1, $this->image_id);
	     
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	    }
	    
	}
 ?>