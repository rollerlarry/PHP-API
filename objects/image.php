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

		//Read image
		function read(){
			$query = "SELECT imageID,imagePath,DateCreated
					FROM 
						" . $this->table_name . "";

		    $stmt = $this->conn->prepare($query);
		    $stmt->execute();
		    
		    return $stmt;
		}

		//Delete image
		function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE imageID = ?";
	        $stmt = $this->conn->prepare($query);
	        $stmt->bindParam(1, $this->iamge_id);
	     
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	    }
	    
	}
 ?>