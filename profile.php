<!doctype html>


<?php 

  session_start(); 
  require_once('inc\connection.php');
  require_once('inc\maintain_posts.php');

  /*  CHECK USER IS VALID USER */

    if ( !(isset($_SESSION['s_id'])) && 13!=count($_SESSION) ) {
        header("location:index.php");  
    }
    


    $user_qurey = "SELECT * FROM `user` WHERE `id` = '{$_SESSION['s_id']}' LIMIT 1";

    $result_set = mysqli_query($con,$user_qurey);

      if(mysqli_num_rows($result_set) == 1){
          $user_details = mysqli_fetch_assoc($result_set);
      }else{
          header("location:index.php"); 
      }



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



 ?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
    <!-- Main css styles-->
    <!--link rel="stylesheet" type="text/css" href="css/theme.css"-->
    <link rel="stylesheet" type="text/css" href="css/default_style.css">
    <link rel="stylesheet" type="text/css" href="css/animations.css">
    <script src="js/bootstrap.min.js"></script>
    

    <script src="js/navi_settings.js"></script>
    <script src="js/search_settings.js"></script>
  
    <?php require_once('inc\bg_manage.php'); ?>


    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    <title>My-edu</title>
      
  </head>



<body onload="nav_config() ;  search_config() " onresize="nav_config() ;  search_config()"> 

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
   



	<div class="container-fluid">

		<div class="row cover_img bgtheme">
                <div class="col-md-12">
                    <div class="logo_panel">
                      <img src="img/logo-mini.png" alt="logo" width="45px" height="45px">
                      <h2>My-edu</h2>
                    </div>

                    <ul id="navigation" >
                      <li id="item0"><a id="link0" href="home.php">Home</a></li>
                      <li id="item1"><a id="link1" href="profile.php">Profile</a></li>
                      <li id="item2"><a id="link2" href="members.php">Members</a></li>
                      <li id="item3"><a id="link3" href="setting.php">Setting</a></li>
                      <li id="item4"><a id="link4" href="logout.php">Logout</a></li>
                    </ul>

                </div>

    </div>

     <div class="row">
      
        <div class="col-md-12">
          
          <div id="search">
                  <form action="profile.php" method="post" autocomplete="on">
                      <input type="text" name="search_text" placeholder="Search documents..." id="s_input">
                      <input type="submit" name="search" value="Search" id="s_btn">
                  </form>
          </div>

        </div>
    </div>


    <div class="row">
      
      <div class="col-md-5">
    
              <table class="p_about bgtheme" >

                  <tr>
                    <td colspan="2" class="my_img" align="center">
                      
                       <?php echo "<img class=\"dp_about\" src=\"{$_SESSION['s_picture']}\" alt=\"profile image\"  width=\"140px\" height=\"140px\">" ?>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2" class="my_name" align="center"><h4 id="display_name"> <?php echo $user_details['f_name'] ." ". $user_details['l_name']; ?> </h4></td>
                  </tr>

                  <tr>
                    <th colspan="2" class="head_topic" >About</th>
                  </tr>

                  <tr>
                    <th class="sub_topic">Birthday</th> <td><?php echo $user_details['dob']; ?></td>
                  </tr>

                  <tr>
                    <th class="sub_topic">Gender</th>
                    <td>
                      <?php 

                            if($user_details['gender']=='m'){
                                echo "Male";
                            }else if($user_details['gender']=='f'){
                                echo "Female";
                            }

                        ?>
                      </td>
                  </tr>

                  <tr>
                    <th class="sub_topic">Email</th> <td><?php echo $user_details['email']; ?></td>
                  </tr>

                  <tr>
                    <th class="sub_topic">Phone</th> <td><?php echo $user_details['phone']; ?></td>
                  </tr>

                  <tr>
                    <th class="sub_topic">City</th> <td><?php echo $user_details['city']; ?></td>
                  </tr>

                  <tr>
                    <th class="sub_topic">Country</th> <td><?php echo $user_details['country']; ?></td>
                  </tr>

                  <tr>
                    <th class="sub_topic">Joined</th> <td><?php echo $user_details['joined']; ?></td>
                  </tr>

              </table>  
      </div>


      <div class="col-md-7">
      
      <?php        

            if (isset($_POST['search']) && $_POST['search_text']!="" ) {
                
                $search_text = $_POST['search_text'] ;

                $getmy_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE  `owner_id` = {$_SESSION['s_id']}  AND `is_deleted` = 0 AND `doc_heading` LIKE '%{$search_text}%' OR `doc_dec` LIKE '%{$search_text}%' ORDER BY doc_id DESC ";
              }else{

                $getmy_docs = "SELECT `doc_id`, `owner_id`, `permission`, `date_time`, `doc_heading`, `valid_for`, `doc_type`, `doc_media`, `doc_dec`, `path`, `is_deleted` FROM `documents` WHERE `owner_id` = {$_SESSION['s_id']}  AND `is_deleted` = 0 ORDER BY doc_id DESC ";

              }



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

                            echo "<td><a href='profile.php?move_to_bin={$post['doc_id']}'><img src='img/bin.png' alt='Delete' width='30px' height='30px'  data-toggle='tooltip' title='Delete'></a></td>";
                              


                            if ($post['permission']=="Public") {
                              echo "<td><a href='profile.php?remove_shared={$post['doc_id']}'><img src='img/shared_red.png' alt='Share' width='30px' height='30px'  data-toggle='tooltip' title='Share'></a></td>";
                                                        }
                            else{
                              echo "<td><a href='profile.php?share={$post['doc_id']}'><img src='img/shared.png' alt='Share' width='30px' height='30px'  data-toggle='tooltip' title='Share'></a></td>";
                            }


                            
                            echo "<td><a href= '{$post['path']}' target='_blank'><img src='img/download.png' alt='Download' width='30px' height='30px'  data-toggle='tooltip' title='Download' ></a></td>";
                            echo "</tr>";

                            echo "</table>"; 
                                        
                      echo "</td>";
                      echo "</tr>";
                      echo "</table>";



              }

            }

      ?>


      </div>


    </div>

  </div>

</body>

</html>