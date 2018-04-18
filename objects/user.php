<?php 
	class User{
		private $conn;
		private $table_name = "tbuser";

		public $user_id;
		public $full_name;
		public $user_name;
		public $password;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT userID,fullName,userName,password 
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
                    fullName=:full_name, userName=:user_name, password=:password";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":full_name", $this->full_name);
	        $stmt->bindParam(":user_name", $this->user_name);
	        $stmt->bindParam(":password", $this->password);

	        if($stmt->execute()){
            return true;
	        }
	     
	        return false;
		}

		// update the user
	    function update(){
	     
	        // update query
	        $query = "UPDATE
	                    " . $this->table_name . "
	                SET
	                    fullName = :full_name,
	                    userName = :user_name,
	                    password = :password
	                WHERE
	                    userID = :user_id";
	     
	        // prepare query statement
	        $stmt = $this->conn->prepare($query);
	     
	     
	        // bind new values
	        $stmt->bindParam(':full_name', $this->full_name);
	        $stmt->bindParam(':user_name', $this->user_name);
	        $stmt->bindParam(':password', $this->password);

	        $stmt->bindParam(':user_id', $this->user_id);
	     
	        // execute the query
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	    }
	    // delete the product
	    function delete(){
	     
	        // delete query
	        $query = "DELETE FROM " . $this->table_name . " WHERE userID = ?";
	     
	        // prepare query
	        $stmt = $this->conn->prepare($query);
	     
	       
	     
	        // bind id of record to delete
	        $stmt->bindParam(1, $this->user_id);
	     
	        // execute query
	        if($stmt->execute()){
	            return true;
	        }
	     
	        return false;
	         
	    }
	}

 ?>