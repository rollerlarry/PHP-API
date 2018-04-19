<?php 
	class Project{
		
		private $conn;
		private $table_name = "tbproject";

		public $project_id;
		public $project_name;
		public $folder_name;


		//Image
		private $table_name_img = "tbimage";
		public $current_user;
		public $date_created;	

		
			
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
    		date_default_timezone_set('Asia/Ho_Chi_Minh');
	        $date_created = date('d-m-Y');
	        $imageDir = '/image/';
			$image_path=$imageDir.$this->folder_name.'/'.$date_created.'/'.$this->current_user;
			$query_img = "INSERT INTO
                    	" . $this->table_name_img . "
                	SET
                    imagePath= '{$image_path}', DateCreated= '{$date_created}'";
            $stmt_img = $this->conn->prepare($query_img);


	        //Move image to folder
	        // Updating ................
		    // $currentDir = getcwd();
		    // $uploadDirectory = "/image/";

		    // $folderName = $this->folder_name ."/";
		    // $dateCreated = $this->date_created ."/";

		    

		    //$uploadPath = $currentDir.$uploadDirectory .$folderName .$dateCreated . basename($fileName); 

		    

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


	        $query_del = "DELETE FROM " . $this->table_name . " WHERE projectID = " . $this->project_id."";
	     	$query_sl = "SELECT folderName FROM " . $this->table_name . " WHERE projectID = " . $this->project_id."";

	        // prepare query
	        $stmt_del = $this->conn->prepare($query_del);


	        $stmt_sl = $this->conn->prepare($query_sl);
		    $stmt_sl->execute();
		    $row = $stmt_sl->fetch(PDO::FETCH_ASSOC);


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

			//get foldername to del it
	        $dirname =  $row['folderName'];
	        delete_directory($dirname);


	        if($stmt_del->execute()){
	            return true;
	        }
	     
	        return false;
	         
	    }
		
	}

 ?>