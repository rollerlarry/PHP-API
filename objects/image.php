<?php 
	class Image{
		private $conn;
		private $table_name = "tbimage";

		public $image_id;
		public $image_path;
		public $date_created;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT imageID,imagePath,DateCreated
					FROM 
						" . $this->table_name . "";

			// prepare query statement
		    $stmt = $this->conn->prepare($query);
		 
		    // execute query
		    $stmt->execute();
		 
		    return $stmt;
		}

		function delete(){
	     
	        // delete query
	        $query = "DELETE FROM " . $this->table_name . " WHERE imageID = ?";
	     
	        // prepare query
	        $stmt = $this->conn->prepare($query);
	     
	       
	     
	        // bind id of record to delete
	        $stmt->bindParam(1, $this->iamge_id);
	     
	        // execute query
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	         
	    }

		
	}

 ?>