<?php 
	class Project{
		private $conn;
		private $table_name = "tbproject";

		public $project_id;
		public $project_name;
		public $folder_name;


		//Image
		private $table_name_img = "tbimage";
		public $date_created;
		public $current_user;

		public function __construct($db){
			$this->conn = $db;
		}

		//Read project
		function read(){
			$query = "SELECT projectID,projectName,folderName
					FROM 
						" . $this->table_name . "";

		    $stmt = $this->conn->prepare($query);
		    // execute query
		    $stmt->execute();
		    return $stmt;
		}

		//Create project
		function create(){

			//Insert project data for sql
			$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    projectName=:project_name, folderName=:folder_name";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":project_name", $this->project_name);
	        $stmt->bindParam(":folder_name", $this->folder_name);

	        //Create folder
    		mkdir('image/'.$this->folder_name);



    		//Insert image path for sql
    		$image_path=$this->folder_name.'/'.$this->current_user;

			$query_img = "INSERT INTO
                    	" . $this->table_name_img . "
                	SET
                    imagePath= '{$image_path}', DateCreated= :date_created";

            $stmt_img = $this->conn->prepare($query_img);

	        $stmt_img->bindParam(":date_created", $this->date_created);


	        //Move image to folder
		    $currentDir = getcwd();
		    $uploadDirectory = "/image/";

		    $folderName = $this->folder_name ."/";
		    $dateCreated = $this->date_created ."/";

		    $errors = []; // Store all foreseen and unforseen errors here

		    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

		    $fileName = $this->current_user;
		    $fileSize = $_FILES['myfile']['size'];
		    $fileTmpName  = $_FILES['myfile']['tmp_name'];
		    $fileType = $_FILES['myfile']['type'];
		    $fileExtension = strtolower(end(explode('.',$fileName)));

		    $uploadPath = $currentDir.$uploadDirectory .$folderName .$dateCreated . basename($fileName); 

		    //Check error in array error
		    if (isset($_POST['submit'])) {

		        if (! in_array($fileExtension,$fileExtensions)) {
		            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
		        }

		        if ($fileSize > 2000000) {
		            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
		        }

		        if (empty($errors)) {
		            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

		            if ($didUpload) {
		                echo "The file " . basename($fileName) . " has been uploaded";
		            } else {
		                echo "An error occurred somewhere. Try again";
		            }
		        } else {
		            foreach ($errors as $error) {
		                echo $error . "These are the errors" . "\n";
		            }
		        }
		    }

	        if($stmt->execute() && $stmt_img->execute()){
            return true;
	        }
	     
	        return false;
		}

		//Update project
	    function update(){
	     
	        $query = "UPDATE
	                    " . $this->table_name . "
	                SET
	                    projectName = :project_name,
	                    folderName = :folder_name
	                WHERE
	                    projectID = :project_id";
	     
	        $stmt = $this->conn->prepare($query);
	     
	     
	        $stmt->bindParam(':project_name', $this->project_name);
	        $stmt->bindParam(':folder_name', $this->folder_name);

	        $stmt->bindParam(':project_id', $this->project_id);
	     
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	    }

	    // Delete project
	    function delete(){

	     	$dbc = mysqli_connect('localhost','root','','db');
	        // delete query
	        //$query_del = "DELETE FROM " . $this->table_name . " WHERE projectID = ?";
	     	$query_del = "SELECT folderName FROM " . $this->table_name . " WHERE projectID = 22";

	        // prepare query
	        $stmt_del = $this->conn->prepare($query_del);
	        //$stmt_sl = $this->conn->prepare($query_sl);

	        // bind id of record to delete
	        //$stmt_del->bindParam(':project_id', $this->project_id);

	        //$stmt_sl->bindParam(1, $this->project_id);
	        // $rows = $stmt_del->fetch(PDO::FETCH_ASSOC);
	        // $need = $rows['folderName'];

	        // rmdir($need);

	        $result_sl = mysqli_query($dbc,$query_del);
	        $rows = mysqli_fetch_assoc($result_sl);

	        
	        //Delete folder and subfolder of project
	       function delete_directory($dirname) {
				         if (is_dir($dirname))
				           $dir_handle = opendir($dirname);
				     if (!$dir_handle)
				          return false;
				     while($file = readdir($dir_handle)) {
				           if ($file != "." && $file != "..") {
				                if (!is_dir($dirname."/".$file))
				                     unlink($dirname."/".$file);
				                else
				                     delete_directory($dirname.'/'.$file);
				           }
				     }
				     closedir($dir_handle);
				     rmdir($dirname);
				     return true;
				}
	        $dirname = $rows['folderName'];

	        delete_directory($dirname);

	        // rmdir('atmbangking');
	     

	        // execute query
	        if($stmt_del->execute()){
	            return true;
	        }
	     
	        return false;
	         
	    }
		
	}

 ?>