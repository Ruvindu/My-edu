<?php

	if (isset($_GET['save'])) {

		$result_set = mysqli_query($con,"INSERT INTO `saved`(`saved_user`, `saved_doc`) VALUES ({$_SESSION['s_id']},{$_GET['save']})"); 
		header("location:home.php#{$_GET['save']}");
		
	}


	if (isset($_GET['saved'])) {

		$result_set = mysqli_query($con,"DELETE FROM `saved` WHERE `saved_user`= {$_SESSION['s_id']} AND `saved_doc` = {$_GET['saved']}"); 
		header("location:home.php#{$_GET['saved']}");

	}


	if (isset($_GET['remove_from_saved'])) {

		$result_set = mysqli_query($con,"DELETE FROM `saved` WHERE `saved_user`= {$_SESSION['s_id']} AND `saved_doc` = {$_GET['remove_from_saved']}");
		header("location:home.php?navigate_to=my_saved");

	}



	if (isset($_GET['remove_shared'])) {
		
		$result_set = mysqli_query($con,"UPDATE `documents` SET `permission`= 'Only me'  WHERE   `doc_id` = {$_GET['remove_shared']} AND `owner_id` = {$_SESSION['s_id']} ");
		//header("location:home.php?navigate_to=my_shared");

	}


	if (isset($_GET['share'])) {
		
		$result_set = mysqli_query($con,"UPDATE `documents` SET `permission`= 'Public'  WHERE  `doc_id` = {$_GET['share']} AND `owner_id` = {$_SESSION['s_id']} ");
		//header("location:home.php?navigate_to=my_docs");

	}


	if (isset($_GET['move_to_bin'])) {
		
		$result_set = mysqli_query($con,"UPDATE `documents` SET `is_deleted`= 1 WHERE  `doc_id` = {$_GET['move_to_bin']} AND `owner_id` = {$_SESSION['s_id']}");
		//header("location:home.php?navigate_to=my_docs");

	}



	if (isset($_GET['restore'])) {
		
		$result_set = mysqli_query($con,"UPDATE `documents` SET `is_deleted`= 0 WHERE  `doc_id` = {$_GET['restore']} AND `owner_id` = {$_SESSION['s_id']}");
		//header("location:home.php?navigate_to=my_docs");

	}




	if (isset($_GET['permanently_delete'])) {

		$result_set = mysqli_query($con,"DELETE FROM `documents` WHERE `doc_id` = {$_GET['permanently_delete']} AND `owner_id` = {$_SESSION['s_id']}");

		//header("location:home.php?navigate_to=bin");

	}


?>
