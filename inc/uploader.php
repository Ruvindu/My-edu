<?php 

    $errors = array();

	if (isset($_POST['upload'])) {

		/* Validate user inputs */


		$valid_for = array();
		$doc_type = $_POST['doc_type'];
		$doc_media = $_POST['doc_media']; 
		$doc_heading = $_POST['doc_heading'];
		$doc_dec = $_POST['doc_dec'];
		$permission = $_POST['permission'];


			if (isset($_POST['school'])) {
				array_push($valid_for,"School");
			}
			if (isset($_POST['university'])) {
				array_push($valid_for,"University");
			}
		
			$valid_for_as_str = implode(" and ",$valid_for);


		if( isset($_FILES['material'])){

			$target_dir = "usr/{$_SESSION['s_id']}/files/";
			$file_name = $_FILES['material']['name'];
			$tmp_file = $_FILES['material']['tmp_name'];
			$path_for_save = $target_dir.$file_name;

			$fileuploaded = 0;

			$fileuploaded = move_uploaded_file($tmp_file, $path_for_save);

			/*prepare time and date */
			$current_date = date("d M Y");
			$current_time =	date("h:i a");	

			$uploaded_at = "$current_date at $current_time";

			/* If file uploaded, then add new recode into database */
			
			if ($fileuploaded) {

				$insert_new_doc = "INSERT INTO `documents`( `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted`) VALUES ({$_SESSION['s_id']}, '{$permission}', '{$uploaded_at}', '{$doc_heading}', '{$valid_for_as_str}' , '{$doc_type}', '{$doc_media}', '{$doc_dec}', '{$path_for_save}', 0)";	

				
				$result = mysqli_query($con,$insert_new_doc);

				if($result){
					echo "<script>";
					echo "alert('Document successfuly uploaded.')";
					echo "</script>";

					//$_POST = array();

				}else{
					echo "<script>";
					echo "alert('Document upload failed.')";
					echo "</script>";
				}

			}else{
				echo "<script>";
				echo "alert('Could not upload the file, try again.')";
				echo "</script>";
			}

		}else{
			echo "<script>";
			echo "alert('Could not identify file path.')";
			echo "</script>";
		}

	}

	


 ?>

