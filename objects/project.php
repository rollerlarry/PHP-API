<?php 
	class Project{
		
		private $conn;
		private $table_name = "tbproject";
		private $table_name_img = "tbimage";

		public $project_id;
		public $project_name;
		public $folder_name;
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

			//Select image id to insert column image id in tbproject
			$query_sl = "SELECT imageID FROM " . $this->table_name_img . " ORDER BY imageID DESC LIMIT 1";
			$stmt_sl = $this->conn->prepare($query_sl);
			$stmt_sl->execute();
			$row = $stmt_sl->fetch(PDO::FETCH_ASSOC);
			$image_id = $row['imageID'] + 1;

			//Insert project data for sql
			$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    projectName=:project_name, folderName=:folder_name, imageID= $image_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":project_name", $this->project_name);
	        $stmt->bindParam(":folder_name", $this->folder_name);


	        if($stmt->execute()){
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