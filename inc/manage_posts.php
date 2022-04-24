<?php


function identify_ico($doc_media)
{
		$icon = "";

		/*select proper icon */
		if ($doc_media=="PDF Document") {
			$icon = "img/pdf_img.png";
		}
		else if($doc_media=="Word Document") {
			$icon = "img/word_img.png";
		}
		else if($doc_media=="Spreadsheet") {
			$icon = "img/spreadsheet_img.png";
		}
		else if($doc_media=="Presentation") {
			$icon = "img/presentation_img.png";
		}

		return $icon;
}




	/*Check is set navigates*/
if (!isset($_GET['navigate_to'])) {
	


	if (isset($_POST['search']) && $_POST['search_text']!="" ) {
		
		$search_text = $_POST['search_text'] ;

		$latest_posts = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `doc_heading` LIKE '%{$search_text}%' OR `doc_dec` LIKE '%{$search_text}%' ORDER BY doc_id DESC ";
	}else{

		$latest_posts = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` ORDER BY doc_id DESC LIMIT 100";
	}


	/* Collecting posts */
        $result_set = mysqli_query($con,$latest_posts);

           if($result_set){
                
 				while ($post = mysqli_fetch_assoc($result_set)) {
 				     
 				   /* get post owner info*/	
 				   	$get_owner_info = "SELECT `f_name`, `l_name`, `picture` FROM `user` WHERE `id` = {$post['owner_id']}";
 				   	$owner_info_resultset = mysqli_query($con,$get_owner_info);
 				   	$owner_info = mysqli_fetch_assoc($owner_info_resultset);

 
 				   		/* This post saved or not */
 				   		$get_saved_info = "SELECT * FROM `saved` WHERE `saved_user`= {$_SESSION['s_id']} AND `saved_doc`= {$post['doc_id']}";
 				   		$saved_post_resultset = mysqli_query($con,$get_saved_info);
 				   		
 				   		if(mysqli_num_rows($saved_post_resultset) >= 1){$saved=1;}
 				   		else{$saved=0;}


 				   		/*select proper icon */
 				   		$icon = identify_ico($post['doc_media']);


				/* create post interface */

				if ( $post['permission']=="Public" && $post['is_deleted']==0 ) {
					
						echo "<table class='doc_frame bgtheme'>";
						echo "<tr>";
						echo "<td colspan='2' class='uploader'>";
						echo "<img src='{$owner_info['picture']}' alt='profile photo' width='40px' height='40px'>";
						echo "<b>{$owner_info['f_name']} {$owner_info['l_name']}</b> <font color='#555'>{$post['date_time']}</font>";
						echo "</td>";
						echo "</tr>";
 
 						echo "<tr>";
						echo "<td rowspan='3' class='doc_ico'><img src='{$icon}' alt='icon' width='150px' height='150px'></td>";
						echo "<th>{$post['doc_heading']}</th>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>";
						if($post['valid_for']!=""){echo "This document important for {$post['valid_for']} students.<br>";};
						
						echo "Category - {$post['doc_type']}<br>";
						echo "<p><b>Description</b> - {$post['doc_dec']}</p>";
						echo "</td>";
						echo "</tr>";

						echo  "<tr>";
				        echo  "<td class'doc_bottom' align='right'>"; 
				                          
				              echo "<table class='bottom_panel1'>";
				              echo "<tr>";

				              if ($saved==1) {
				               	echo "<td><a href='home.php?saved={$post['doc_id']}' name='{$post['doc_id']}'><img src='img/saved%20red.png' alt='Save' width='30px' height='30px'  data-toggle='tooltip' title='Save'></a></td>";
				              }
				              else{
				              	echo "<td><a href='home.php?save={$post['doc_id']}' name='{$post['doc_id']}'><img src='img/saved.png' alt='Save' width='30px' height='30px'  data-toggle='tooltip' title='Save'></a></td>";
				              } 
				                                  
				              echo "<td><a href= '{$post['path']}' target='_blank'><img src='img/download.png' alt='Download' width='30px' height='30px'  data-toggle='tooltip' title='Download' ></a></td>";
				              echo "</tr>";

				              echo "</table>"; 
				                          
				        echo "</td>";
				        echo "</tr>";
				        echo "</table>";
				}

 			}               
                
        }


}else{


	if ($_GET['navigate_to']=='my_docs') {
		
		$getmy_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `owner_id` = {$_SESSION['s_id']} AND `permission` = 'Only me' AND `is_deleted` = 0 ORDER BY doc_id DESC ";




			/* Collecting my private posts */
        $my_docs_result_set = mysqli_query($con,$getmy_docs);

           if(mysqli_num_rows($my_docs_result_set) >= 1){
                
 				while ($post = mysqli_fetch_assoc($my_docs_result_set)) {
 						
 				

 						/*select proper icon */
 				   		$icon = identify_ico($post['doc_media']);


 				   		echo "<table class='doc_frame bgtheme'>";
						echo "<tr>";
						echo "<td colspan='2' class='uploader' style='padding:10px;'>";
						echo "<font color='#555' >{$post['date_time']}</font>";
						echo "</td>";
						echo "</tr>";
 
 						echo "<tr>";
						echo "<td rowspan='3' class='doc_ico'><img src='{$icon}' alt='icon' width='150px' height='150px'></td>";
						echo "<th>{$post['doc_heading']}<br><br></th>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>";
						if($post['valid_for']!=""){echo "This document important for {$post['valid_for']} students.<br>";};
						
						echo "Category - {$post['doc_type']}<br>";
						echo "<p><b>Description</b> - {$post['doc_dec']}</p>";
						echo "</td>";
						echo "</tr>";

						echo  "<tr>";
				        echo  "<td class'doc_bottom' align='right'>"; 
				                          
				              echo "<table class='bottom_panel1'>";
				              echo "<tr>";

				              echo "<td><a href='home.php?move_to_bin={$post['doc_id']}'><img src='img/bin.png' alt='Delete' width='30px' height='30px'  data-toggle='tooltip' title='Delete'></a></td>";
				              
				              echo "<td><a href='home.php?share={$post['doc_id']}'><img src='img/shared.png' alt='Share' width='30px' height='30px'  data-toggle='tooltip' title='Share'></a></td>";
				              
				              echo "<td><a href= '{$post['path']}' target='_blank'><img src='img/download.png' alt='Download' width='30px' height='30px'  data-toggle='tooltip' title='Download' ></a></td>";
				              echo "</tr>";

				              echo "</table>"; 
				                          
				        echo "</td>";
				        echo "</tr>";
				        echo "</table>";



 				}

 			}



	}else if ($_GET['navigate_to']=='my_shared') {
		

		$get_shared_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `owner_id` = {$_SESSION['s_id']} AND `permission` = 'Public' AND `is_deleted` = 0 ORDER BY doc_id DESC ";




			/* Collecting my private posts */
        $my_docs_result_set = mysqli_query($con,$get_shared_docs);

           if(mysqli_num_rows($my_docs_result_set) >= 1){
                
 				while ($post = mysqli_fetch_assoc($my_docs_result_set)) {
 						
 				

 						/*select proper icon */
 				   		$icon = identify_ico($post['doc_media']);


 				   		echo "<table class='doc_frame bgtheme'>";
						echo "<tr>";
						echo "<td colspan='2' class='uploader' style='padding:10px;'>";
						echo "<font color='#555' >{$post['date_time']}</font>";
						echo "</td>";
						echo "</tr>";
 
 						echo "<tr>";
						echo "<td rowspan='3' class='doc_ico'><img src='{$icon}' alt='icon' width='150px' height='150px'></td>";
						echo "<th>{$post['doc_heading']}<br><br></th>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>";
						if($post['valid_for']!=""){echo "This document important for {$post['valid_for']} students.<br>";};
						
						echo "Category - {$post['doc_type']}<br>";
						echo "<p><b>Description</b> - {$post['doc_dec']}</p>";
						echo "</td>";
						echo "</tr>";

						echo  "<tr>";
				        echo  "<td class'doc_bottom' align='right'>"; 
				                          
				              echo "<table class='bottom_panel1'>";
				              echo "<tr>";

				              echo "<td><a href='home.php?move_to_bin={$post['doc_id']}'><img src='img/bin.png' alt='Delete' width='30px' height='30px'  data-toggle='tooltip' title='Delete'></a></td>";

				              echo "<td><a href='home.php?remove_shared={$post['doc_id']}' ><img src='img/shared_red.png' alt='Shared' width='30px' height='30px'  data-toggle='tooltip' title='Share'></a></td>";

				              echo "<td><a href= '{$post['path']}' target='_blank'><img src='img/download.png' alt='Download' width='30px' height='30px'  data-toggle='tooltip' title='Download' ></a></td>";
				              echo "</tr>";

				              echo "</table>"; 
				                          
				        echo "</td>";
				        echo "</tr>";
				        echo "</table>";



 				}

 			}




	}else if ($_GET['navigate_to']=='my_saved') {


		$getmy_saved = "SELECT `saved_user`, `saved_doc` FROM `saved` WHERE `saved_user` = {$_SESSION['s_id']}";

			/* Collecting my saved posts */
        $my_docs_result_set = mysqli_query($con,$getmy_saved);

           if(mysqli_num_rows($my_docs_result_set) >= 1){


           		while ($post = mysqli_fetch_assoc($my_docs_result_set)) {
           			
           			/* get post info*/
           			$get_saved_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `doc_id` = {$post['saved_doc']}  AND  `permission` = 'Public' AND `is_deleted` = 0  ORDER BY doc_id DESC ";
           			$get_saved_docs_resultset = mysqli_query($con,$get_saved_docs);
 				   	$saved_docs = mysqli_fetch_assoc($get_saved_docs_resultset);


           			/* get post owner info*/	
 				   	$get_owner_info = "SELECT `f_name`, `l_name`, `picture` FROM `user` WHERE `id` = {$saved_docs['owner_id']}";
 				   	$owner_info_resultset = mysqli_query($con,$get_owner_info);
 				   	$owner_info = mysqli_fetch_assoc($owner_info_resultset);

 				   		/*Get icon*/
 				   		$icon = identify_ico($saved_docs['doc_media']);
 				   		

 				   		echo "<table class='doc_frame bgtheme'>";
						echo "<tr>";
						echo "<td colspan='2' class='uploader'>";
						echo "<img src='{$owner_info['picture']}' alt='profile photo' width='40px' height='40px'>";
						echo "<b>{$owner_info['f_name']} {$owner_info['l_name']}</b> <font color='#555'>{$saved_docs['date_time']}</font>";
						echo "</td>";
						echo "</tr>";
 
 						echo "<tr>";
						echo "<td rowspan='3' class='doc_ico'><img src='{$icon}' alt='icon' width='150px' height='150px'></td>";
						echo "<th>{$saved_docs['doc_heading']}</th>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>";
						if($saved_docs['valid_for']!=""){echo "This document important for {$saved_docs['valid_for']} students.<br>";};
						
						echo "Category - {$saved_docs['doc_type']}<br>";
						echo "<p><b>Description</b> - {$saved_docs['doc_dec']}</p>";
						echo "</td>";
						echo "</tr>";

						echo  "<tr>";
				        echo  "<td class'doc_bottom' align='right'>"; 
				                          
				              echo "<table class='bottom_panel1'>";
				              echo "<tr>";

				              
				              echo "<td><a href='home.php?remove_from_saved={$saved_docs['doc_id']}' ><img src='img/saved%20red.png' alt='Save' width='30px' height='30px'  data-toggle='tooltip' title='Save'></a></td>";
				             
				                                  
				              echo "<td><a href= '{$saved_docs['path']}' target='_blank'><img src='img/download.png' alt='Download' width='30px' height='30px'  data-toggle='tooltip' title='Download' ></a>  
				              </td>";
				              echo "</tr>";

				              echo "</table>"; 
				                          
				        echo "</td>";
				        echo "</tr>";
				        echo "</table>";


           		}


           }



		
	}else if ($_GET['navigate_to']=='my_bin') {
		
		$get_shared_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `owner_id` = {$_SESSION['s_id']}  AND `is_deleted` = 1  ORDER BY doc_id DESC ";


			/* Collecting my private posts */
        $my_docs_result_set = mysqli_query($con,$get_shared_docs);

           if(mysqli_num_rows($my_docs_result_set) >= 1){
                
 				while ($post = mysqli_fetch_assoc($my_docs_result_set)) {
 						
 				

 						/*select proper icon */
 				   		$icon = identify_ico($post['doc_media']);


 				   		echo "<table class='doc_frame bgtheme'>";
						echo "<tr>";
						echo "<td colspan='2' class='uploader' style='padding:10px;'>";
						echo "<font color='#555' >{$post['date_time']}</font>";
						echo "</td>";
						echo "</tr>";
 
 						echo "<tr>";
						echo "<td rowspan='3' class='doc_ico'><img src='{$icon}' alt='icon' width='150px' height='150px'></td>";
						echo "<th>{$post['doc_heading']}<br><br></th>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>";
						if($post['valid_for']!=""){echo "This document important for {$post['valid_for']} students.<br>";};
						
						echo "Category - {$post['doc_type']}<br>";
						echo "<p><b>Description</b> - {$post['doc_dec']}</p>";
						echo "</td>";
						echo "</tr>";

						echo  "<tr>";
				        echo  "<td class'doc_bottom' align='right'>"; 
				                          
				              echo "<table class='bottom_panel1'>";
				              echo "<tr>";

				              echo "<td><a href='home.php?permanently_delete={$post['doc_id']}' onclick=\"return confirm('Are you sure you want to permanently delete this document?')\"><img src='img/bin.png' alt='Permanently delete' width='30px' height='30px'  data-toggle='tooltip' title='Permanently delete'></a></td>";

				              echo "<td><a href='home.php?restore={$post['doc_id']}' ><img src='img/restore.png' alt='Restore' width='30px' height='30px'  data-toggle='tooltip' title='Restore' ></a></td>";
				              echo "</tr>";

				              echo "</table>"; 
				                          
				        echo "</td>";
				        echo "</tr>";
				        echo "</table>";



 				}

 			}



	}

}

?>