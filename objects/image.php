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


		function update(){
			// date_default_timezone_set('Asia/Ho_Chi_Minh');
	  //       $date_created = date('d-m-Y');
	  //       $imageDir = '/image/';
			// $image_path=$imageDir.$this->folder_name.'/'.$date_created.'/'.$this->current_user;
			// $query_img = "INSERT INTO
   //                  	" . $this->table_name_img . "
   //              	SET
   //                  imagePath= '{$image_path}', DateCreated= '{$date_created}'";
   //          $stmt_img = $this->conn->prepare($query_img);

   //          //Move image to folder
		 //    $currentDir = getcwd();
		 //    $uploadDirectory = "/image/";

		 //    $folderName = $this->folder_name ."/";
		 //    $dateCreated = $this->date_created ."/";

		 //    $errors = []; // Store all foreseen and unforseen errors here

		 //    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

		 //    $fileName = $this->current_user;
		 //    $fileSize = $_FILES['myfile']['size'];
		 //    $fileTmpName  = $_FILES['myfile']['tmp_name'];
		 //    $fileType = $_FILES['myfile']['type'];
		 //    $fileExtension = strtolower(end(explode('.',$fileName)));

		 //    $uploadPath = $currentDir.$uploadDirectory .$folderName .$dateCreated . basename($fileName); 

		 //    //Check error in array error
		 //    if (isset($_POST['submit'])) {

		 //        if (! in_array($fileExtension,$fileExtensions)) {
		 //            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
		 //        }

		 //        if ($fileSize > 2000000) {
		 //            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
		 //        }

		 //        if (empty($errors)) {
		 //            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

		 //            if ($didUpload) {
		 //                echo "The file " . basename($fileName) . " has been uploaded";
		 //            } else {
		 //                echo "An error occurred somewhere. Try again";
		 //            }
		 //        } else {
		 //            foreach ($errors as $error) {
		 //                echo $error . "These are the errors" . "\n";
		 //            }
		 //        }
		 //    }

		 //    if($stmt_img->execute()){
   //          return true;
	  //       }
	     
	  //       return false;

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