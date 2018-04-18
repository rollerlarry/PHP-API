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

		function read(){
			$query = "SELECT projectID,projectName,folderName
					FROM 
						" . $this->table_name . "";

			// prepare query statement
		    $stmt = $this->conn->prepare($query);

		    
		 
		    // execute query
		    $stmt->execute();
		 
		    return $stmt;
		}

		function create(){
			$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    projectName=:project_name, folderName=:folder_name";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":project_name", $this->project_name);
	        $stmt->bindParam(":folder_name", $this->folder_name);

	        //create folder
	        	
    		mkdir('image/'.$this->folder_name);




    		$image_path=$this->folder_name.'/'.$this->current_user;

			$query_img = "INSERT INTO
                    	" . $this->table_name_img . "
                	SET
                    imagePath= '{$image_path}', DateCreated= :date_created";

            $stmt_img = $this->conn->prepare($query_img);

	        $stmt_img->bindParam(":date_created", $this->date_created);

			//move_uploaded_file($_FILES['img']['tmp_name'],"image/".$this->folder_name."/".$this->$date_created."/".$this->current_user);

	        if($stmt->execute() && $stmt_img->execute()){
            return true;
	        }
	     
	        return false;
		}

		// update the project
	    function update(){
	     
	        // update query
	        $query = "UPDATE
	                    " . $this->table_name . "
	                SET
	                    projectName = :project_name,
	                    folderName = :folder_name
	                WHERE
	                    projectID = :project_id";
	     
	        // prepare query statement
	        $stmt = $this->conn->prepare($query);
	     
	     
	        // bind new values
	        $stmt->bindParam(':project_name', $this->project_name);
	        $stmt->bindParam(':folder_name', $this->folder_name);

	        $stmt->bindParam(':project_id', $this->project_id);
	     
	   
	        // execute the query
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	    }

	    // delete the product
	    function delete(){

	    	//$abc =  $this->project_id;

	    	//$cde = echo $abc;

	     	$dbc = mysqli_connect('localhost','root','','db');
	        // delete query
	        //$query_del = "DELETE FROM " . $this->table_name . " WHERE projectID = ?";
	     	$query_del = "SELECT folderName FROM " . $this->table_name . " WHERE projectID = 1";

	        // prepare query
	        $stmt_del = $this->conn->prepare($query_del);
	        //$stmt_sl = $this->conn->prepare($query_sl);

	        // bind id of record to delete
	        //$stmt_del->bindParam(':project_id', $this->project_id);

	        //$stmt_sl->bindParam(1, $this->project_id);
	        // $rows = $stmt_del->fetch(PDO::FETCH_ASSOC);
	        // $need = $rows['folderName'];

	        // rmdir($need);

	        // $result_sl = mysqli_query($dbc,$query_del);
	        // $rows = mysqli_fetch_assoc($result_sl);

	        

	       
	        //rmdir($rows['folderName']);


	        // rmdir('atmbangking');
	     

	        // execute query
	        if($stmt_del->execute()){
	            return true;
	        }
	     
	        return false;
	         
	    }
		
	}

 ?>