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

		
	}

 ?>