<!doctype html>


<?php 

  session_start(); 
  require_once('inc\connection.php');
  require_once('inc\uploader.php');
  require_once('inc\maintain_posts.php');

  /*  CHECK USER IS VALID USER */

    if ( !(isset($_SESSION['s_id'])) && 13!=count($_SESSION)) {
        header("location:index.php");  
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
    <script src="js/dp_settings.js"></script>
    <script src="js/search_settings.js"></script>
    <script src="js/leftnavi_settings.js"></script>

     <?php require_once('inc\bg_manage.php'); ?> 
    <title>My-edu</title>
      
    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />

  </head>



<body onload="nav_config() ; dp_config() ; search_config() ; leftnavi_config()" onresize="nav_config() ; dp_config() ; search_config() ; leftnavi_config()"> 

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
      <div class="col-md-7">
            <div id="user">
              
              <?php echo "<img id=\"dp\" src=\"{$_SESSION['s_picture']}\" alt=\"profile image\"  width=\"130px\" height=\"130px\">" ?>

              <div>
                <h4 id="display_name"> <?php echo $_SESSION['s_fname'] ." ". $_SESSION['s_lname']; ?> </h4>
                <p id="display_other"> <?php echo $_SESSION['s_city']; ?> <br> <?php echo $_SESSION['s_country']; ?> </p>
              </div>
            </div>
        </div>

        <div class="col-md-5">
          
          <div id="search">
                  <form action="home.php" method="post" autocomplete="on">
                      <input type="text" name="search_text" placeholder="Search documents..." id="s_input">
                      <input type="submit" name="search" value="Search" id="s_btn">
                  </form>
          </div>

        </div>
    </div>


    <div class="row">
      
      <div class="col-md-4">

        <table class="bgtheme" id="left_navi">

          <tr>
            <td> <a href="home.php?navigate_to=my_docs"><img src="img/my-doc.png" width="30px" height="30px"> My documents </a> </td>
          </tr>

          <tr>
            <td> <a href="home.php?navigate_to=my_shared"><img src="img/shared.png" width="30px" height="30px"> Shared </a> </td>
          </tr>

          <tr>
            <td> <a href="home.php?navigate_to=my_saved"><img src="img/saved.png" width="30px" height="30px"> Saved </a> </td>
          </tr>

          <tr>
            <td> <a href="home.php?navigate_to=my_bin"><img src="img/bin.png" width="30px" height="30px"> Bin </a> </td>
          </tr>
        </table>
        
      </div>


      <div class="col-md-7">
          
          
      <!-- Upload education materials -->
      <form action="home.php" method="post" enctype="multipart/form-data">
          <table class="bgtheme upload_panel" >
            <tr>
              <td>Upload education material</td>
              <td colspan="3"><input type="file" name="material" value="Browse" class="upload_btn" required></td>
            </tr>

            <tr>
              <td>Important for</td>
              <td colspan="3">
                    <div class="upload_check">
                        <input type="checkbox" id="school" name="school">
                        <label for="school">School</label>
                
                        <input type="checkbox" id="university" name="university">
                        <label for="university">University</label>
                    </div>
              </td>
            </tr>


            <tr>
              <td>
                Document Category
              </td>
              <td>
                <select class="upload_selector" name="doc_type">
                  <option>Paper</option>
                  <option>Note</option>
                  <option>Other</option>
                </select>
              </td>

              <td align="right">Media</td>
              <td>
                <select class="upload_selector" name="doc_media">
                  <option>PDF Document</option>
                  <option>Word Document</option>
                  <option>Spreadsheet</option>
                  <option>Presentation</option>
                </select>
              </td>
            </tr>


            <tr>
              <td>Document heading</td>
              <td colspan="3"><input type="text" name="doc_heading" required></td>
            </tr>


            <tr>
              <td>Description</td>
              <td colspan="3"><textarea name="doc_dec" required></textarea></td>
            </tr>

            <tr>
              <td>Share with</td> 
              <td>
                  <select class="upload_selector" name="permission">
                    <option>Public</option>
                    <option>Only me</option>
                  </select>

              </td> 
              <td colspan="2" align="right"><input type="submit" name="upload" value="Upload"></td>
            </tr>

          </table>
      </form>


      <!--posts-->
      <?php 
          require_once('inc\manage_posts.php');
       ?>   
                          
      
      </div>

    </div>

  </div>

</body>

</html>
