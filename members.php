<!doctype html>

<?php
  
    session_start(); 
    require_once('inc\connection.php');



    $get_privacy = "SELECT * FROM `privacy` WHERE {$_SESSION['s_id']}";

    $result=mysqli_query($con,$get_privacy);

    if ($result) {
        $privacy = mysqli_fetch_assoc($result);
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

    <title>My-edu</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    
  </head>


<body onload="nav_config()  ; search_config()" onresize="nav_config() ; search_config()"> 

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
                  <form action="members.php" method="post" autocomplete="on">
                      <input type="text" name="search_text" placeholder="Search members..." id="s_input">
                      <input type="submit" name="search" value="Search" id="s_btn">
                  </form>
          </div>

        </div>
    </div>


    <div class="row">

        
        
      <div class="col-md-12" align="center">

        <?php
          
          if (isset($_POST['search'])) {

              $search_text_ar = explode(" ",$_POST['search_text']);

              if (sizeof($search_text_ar)==2) {
                 $members = "SELECT `id`, `f_name`, `l_name`, `city`, `country`, `picture` FROM `user` WHERE  id != {$_SESSION['s_id']} AND `f_name` LIKE '%{$search_text_ar[0]}%' AND `l_name` LIKE '%{$search_text_ar[1]}%' ";
              }else{
                $members = "SELECT `id`, `f_name`, `l_name`, `city`, `country`, `picture` FROM `user` WHERE  id != {$_SESSION['s_id']} AND `f_name` LIKE '%{$search_text_ar[0]}%' ";
              }

          }else{
              $members = "SELECT `id`, `f_name`, `l_name`, `city`, `country`, `picture` FROM `user` WHERE  id != {$_SESSION['s_id']}";
          }

          $result_set = mysqli_query($con,$members);

      
              while ($member = mysqli_fetch_assoc($result_set)) {
                

                $get_public_count = "SELECT COUNT(*) as count FROM `documents` WHERE `permission` = 'Public' AND `owner_id` = {$member['id']}";
                $get_onlyme_count = "SELECT COUNT(*) as count FROM `documents` WHERE `permission` = 'Only me' AND `owner_id` = {$member['id']}";

                $result_public_count = mysqli_fetch_assoc(mysqli_query($con,$get_public_count));
                $result_onlyme_count = mysqli_fetch_assoc(mysqli_query($con,$get_onlyme_count));

                
                $available_docs = $result_public_count['count'] + $result_onlyme_count['count'];
                $shared_docs = $result_public_count['count'];


                echo "<a href='member_profile.php?member_id={$member['id']}' class='member_link'>";
                echo "<table class='member bgtheme' >";

                echo "<tr>";
                echo "<td width='80px' rowspan='2'>";
                echo "<img src='{$member['picture']}' width='80px' height='80px' class='member_dp'>";
                echo "</td>";
                echo "<td class='m_name'colspan='2'>";
                echo " {$member['f_name']} {$member['l_name']} ";        
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>";
                $coma = 1;
                if(strcmp($privacy['city'], "public")==0){ echo "{$member['city']}"; } else { $coma = 0;} ; 
                
                if(strcmp($privacy['country'], "public")==0){ if ($coma) { echo ", ";} echo "{$member['country']}"; } ;
                echo "</td>";

                echo "<td>";
                echo "<table align='right' class='m_notifi'>";
                  echo "<tr>";
                  echo "<td><img src='img/my-doc.png' alt='Available documents' width='25px' height='25px'>{$available_docs}</td>";
                  echo "<td><img src='img/shared.png' alt='Shared documents' width='25px' height='25px'>{$shared_docs}</td>";
                  echo "</tr>";
                echo "</table>";
                echo "</td>";

                echo "</tr>";
                echo "</table>";
                echo "</a>";


              }


          

      ?>

          
      </div>

        
        
    </div>
        
</div>

</body>

</html>