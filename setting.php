<!ddoctype html>

<?php
  
    session_start(); 
    require_once('inc\connection.php');

    /*  CHECK USER IS VALID USER */

    if ( !(isset($_SESSION['s_id'])) && 13!=count($_SESSION)) {
        header("location:index.php");  
    }


/* Save profile picture */
  
    if (isset($_POST['save_profile'])) {
      

       if( isset($_FILES['selected_image']) ){

            $target_dir = "usr/{$_SESSION['s_id']}/profile/";
            $file_name = $_FILES['selected_image']['name'];
            $tmp_file = $_FILES['selected_image']['tmp_name'];
            $path_for_save = $target_dir.$file_name;
 
            $fileuploaded = 0;

            $fileuploaded = move_uploaded_file($tmp_file, $path_for_save);

            if ($fileuploaded) {
              
              $save_profile_img = "UPDATE `user` SET `picture`= '{$path_for_save}' WHERE id = '{$_SESSION['s_id']}'";

              $result = mysqli_query($con,$save_profile_img);

              if ($result) {
                $_SESSION['s_picture'] = $path_for_save;
                echo "<script> alert('Profile picture successfuly uploaded.'); </script>";
              }

            }

            

        }
        else{

            echo "<script> alert('No file selected.'); </script>";

        }
  

    }


/* Remove current profile picture*/

  if (isset($_POST['remove_profile'])) {
    

     $save_profile_img = "UPDATE `user` SET `picture`= 'img/dp.png' WHERE id = '{$_SESSION['s_id']}'";

      $result = mysqli_query($con,$save_profile_img);

      if ($result) {
        $_SESSION['s_picture'] = "img/dp.png";
        echo "<script> alert('Profile picture removed.'); </script>";
      }


   
  }



    //PASSWORD CHANGING
   

    if (isset($_POST['change'])){
      
      $Select_pwd="SELECT `password` FROM `user` WHERE `id`={$_SESSION['s_id']}";
      $result=mysqli_query($con,$Select_pwd);

      if($result){
        $current_enc_pwd=mysqli_fetch_assoc($result);
        

        if(strcmp(sha1($_POST['current_pwd']),$current_enc_pwd['password'])==0) {
          

         if(strcmp(sha1($_POST['new_pwd']),sha1($_POST['confirm_pwd']))==0) {
           
           if (7 < strlen($_POST['new_pwd']) ) {

                $encrypted_pwd=sha1($_POST['confirm_pwd']);

               $Update_pwd="UPDATE `user` SET `password` = '{$encrypted_pwd}' WHERE `id`= {$_SESSION['s_id']} ";

               $result=mysqli_query($con,$Update_pwd);

               if($result){
                 
                  echo "<script>alert('Password changed successfully.. ')</script>";  
               }

               
          }
          else{
            echo "<script>alert('Password must contain more than 8 characters ')</script>";
          }

        

         }else{
           echo "<script>alert(' Passwords are not matching ')</script>";
         }


        }else{        
          echo "<script>alert('Current password is not valid..')</script>";
        }

      }


    }





//UPDATE USER DETAILS

    if (isset($_POST['update_data'])){

      if (strcmp($_POST['gender'], "male")==0) {
        $g = "m";
      }
      if (strcmp($_POST['gender'], "female")==0) {
        $g = "f";
      }

      $Select_user_details = "UPDATE `user` SET `f_name` = '{$_POST['f_name']}' ,`l_name` = '{$_POST['l_name']}',`email`= '{$_POST['email']}',`phone`='{$_POST['phone']}',`dob`='{$_POST['dob']}',`gender`='$g',`city`='{$_POST['city']}',`country`='{$_POST['country']}' WHERE `id`= {$_SESSION['s_id']}";


      $result=mysqli_query($con,$Select_user_details);

         if($result){
            echo "<script>alert('User details updated successfully..')</script>";
         }else{
            echo "<script>alert('Somthing went wrong.Updated faild.')</script>";
         }

   }




  /* change privacy*/


if (isset($_POST['save_privacy'])) {
  

  $update_privacy = "UPDATE `privacy` SET `user_id` = {$_SESSION['s_id']},`phone`= '{$_POST['phone']}',`email`='{$_POST['email']}',`dob`='{$_POST['dob']}',`city`='{$_POST['city']}',`country`='{$_POST['country']}',`join_date`='{$_POST['join_date']}' WHERE `user_id`= '{$_SESSION['s_id']}'";


  $result = mysqli_query($con,$update_privacy);

   if($result){
      echo "<script>alert('Privacy updated successfully.')</script>";
   }else{
      echo "<script>alert('Somthing went wrong.Updated faild.')</script>";
   }


}



/*Set theme*/

if (isset($_POST['set_theme'])) {
  
    if( isset($_FILES['theme_image']) ){

            $target_dir = "usr/{$_SESSION['s_id']}/theme/";
            $file_name = $_FILES['theme_image']['name'];
            $tmp_file = $_FILES['theme_image']['tmp_name'];
            $path_for_save = $target_dir.$file_name;
 
            $fileuploaded = 0;

            $fileuploaded = move_uploaded_file($tmp_file, $path_for_save);

            if ($fileuploaded) {
              
              $save_profile_img = "UPDATE `user` SET `theme`= '{$path_for_save}' WHERE id = '{$_SESSION['s_id']}'";

              $result = mysqli_query($con,$save_profile_img);

              if ($result) {
                $_SESSION['s_theme'] = $path_for_save;
                echo "<script> alert('Theme image successfuly uploaded.'); </script>";
              }

            }

            

        }
        else{

            echo "<script> alert('No file selected.'); </script>";

        }
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
      
    <?php require_once('inc\bg_manage.php'); ?>

    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    <title>My-edu</title>
      
  </head>


<body onload="nav_config()" onresize="nav_config()"> 

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
   

    <script type="text/javascript">
        
        $(document).ready(function(){
           $(".s1").hide();

          $(".s_menu1").click(function(){
            $(".s1").slideToggle();
          });
        });

        $(document).ready(function(){
          $(".s2").hide();

          $(".s_menu2").click(function(){
            $(".s2").slideToggle();
          });
        });

        $(document).ready(function(){
          $(".s3").hide();

          $(".s_menu3").click(function(){
            $(".s3").slideToggle();
          });
        });

        $(document).ready(function(){
          $(".s4").hide();

          $(".s_menu4").click(function(){
            $(".s4").slideToggle();
          });
        });

        $(document).ready(function(){
          $(".s5").hide();

          $(".s_menu5").click(function(){
            $(".s5").slideToggle();
          });
        });

    </script>


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


<center>

<div class="row">

  <!--profile picture settings-->
  <div class="col-md-12">
      <div class="s_menu1 bgtheme"><h3>Profile picture settings</h3></div>

      <div class="s1">
        <table class="profile_setting">
          <form action="setting.php" method="post" enctype="multipart/form-data">

            <tr>
              <!--td colspan=2><img src="img/dp.png" alt="Profile image" width="200px" height="200px"></td-->
            </tr>

            <tr>
              <td colspan=2><input type="file" name="selected_image" value="Browse" class="file_chooser form-control"></td>
            </tr>

            <tr>
              <td><input type="submit" name="save_profile" value="Save" class="default_btn w_btn_100px"></td>
              <td><input type="submit" name="remove_profile" value="Remove"  class="default_btn w_btn_100px"></td>
            </tr>

          </form>
        </table>
      </div>
  </div>

</div>



<div class="row">

  
  <?php
    
    $Select_user_details="SELECT `f_name`,`l_name`,`email`,`phone`,`dob`,`gender`,`city`,`country` FROM `user` WHERE `id`= {$_SESSION['s_id']}";
   
    $result=mysqli_query($con,$Select_user_details);

    if ($result){
      $userdetails=mysqli_fetch_assoc($result);
      
    } 

  ?>



  <!--Personal information-->
  <div class="col-md-12">
       <div class="s_menu2 bgtheme"><h3>Personal information</h3></div>

       <div class="s2">
         
           <table class="profile_setting">

            <form action="setting.php" method="post">

            <tr>
              <td><input  class="text_input w_ti_200px" type="text" name="f_name" placeholder="First name" required <?php echo "value={$userdetails['f_name']}";?>  ></td>
              <td><input  class="text_input w_ti_200px" type="text" name="l_name" placeholder="Last name" required <?php echo "value={$userdetails['l_name']}";?>></td>
            </tr>


            <tr>
              <td colspan="2"><input class="text_input w_ti_412px" type="email" name="email" placeholder="Email" required  <?php echo "value={$userdetails['email']}";?>></td>
            </tr>


            <tr>
              <td colspan="2"><input class="text_input w_ti_412px" type="text" name="phone" placeholder="phone" required  <?php echo "value={$userdetails['phone']}";?>></td>
            </tr>



            <tr>
               <td> <div class="lable_dob">Birth of date</div> </td>
               <td><input class="text_input w_ti_200px" type="date" name="dob" placeholder="Date of birth"  required  <?php echo "value={$userdetails['dob']}";?>></td>
            </tr>


            <tr>
                <td> <div class="lable_gender">Gender</div> </td>
                  <td>
                      <div class="gender_class">
                          <label class="label_select">
                          <input name="gender" type="radio"  value="male" <?php if($userdetails['gender']=="m"){echo "checked";} ?> />
                          <span>Male</span>
                          </label>
                              <label class="label_select">
                              <input name="gender" type="radio"  value="female"  <?php if($userdetails['gender']=="f"){echo "checked";} ?> />
                              <span>Female</span>
                          </label>                          
                      </div>                
                  </td>
            </tr>

                <tr>
                  <td colspan="2"><input  class="text_input w_ti_412px" type="text" name="city" placeholder="City" required  <?php echo "value={$userdetails['city']}";?>></td>
                </tr>

                <tr>
                  <td colspan="2"><input  class="text_input w_ti_412px" type="text" name="country" placeholder="Country" required  <?php $country = $userdetails['country']; echo "value={$country}"; ?> ></td>
                </tr>

                <tr>
                  <td colspan="2" align="center"><input  class="default_btn w_btn_180px" type="submit" name="update_data" value="Save"></td>
                </tr>
            </form>

          </table>

       </div>
  </div>


</div>



<div class="row">


  <?php

    $get_privacy = "SELECT * FROM `privacy` WHERE `user_id` = {$_SESSION['s_id']}";

    $result=mysqli_query($con,$get_privacy);

    if ($result) {
        $privacy = mysqli_fetch_assoc($result);
    }

  ?>



  <!--privacy and security setting-->
  <div class="col-md-12">
       <div class="s_menu3 bgtheme"><h3>Privacy and security setting</h3></div>

       <div class="s3">
         
            <table class="profile_setting">

            <form action="setting.php" method="post">
            

            <tr>
              <td class="labels">Phone</td>
              <td>
                <select class="text_input w_ti_200px" name="phone">
                  <option  <?php if(strcmp($privacy['phone'], "public")==0){echo "selected";} ?> value='public' >Public</option>
                  <option  <?php if(strcmp($privacy['phone'], "onlyme")==0){echo "selected";} ?> value='onlyme' >Only me</option>
                </select>
              </td>
            </tr>

            <tr>
              <td class="labels">Email</td>
              <td>
                <select class="text_input w_ti_200px" name="email">
                  <option <?php if(strcmp($privacy['email'], "public")==0){echo "selected";} ?> value='public' >Public</option>
                  <option <?php if(strcmp($privacy['email'], "onlyme")==0){echo "selected";} ?> value='onlyme' >Only me</option>
                </select>
              </td>
            </tr>


            <tr> 
              <td class="labels">Birthday</td>
              <td>
                <select class="text_input w_ti_200px" name="dob">
                  <option <?php if(strcmp($privacy['dob'], "full")==0){echo "selected";} ?> value='full' >With year</option>
                  <option <?php if(strcmp($privacy['dob'], "half")==0){echo "selected";} ?> value='half' >Month and day</option>
                </select>
              </td>
            </tr>

            <tr>
              <td class="labels">City</td>
              <td>
                <select class="text_input w_ti_200px" name="city">
                  <option <?php if(strcmp($privacy['city'], "public")==0){echo "selected";} ?> value='public' >Public</option>
                  <option <?php if(strcmp($privacy['city'], "onlyme")==0){echo "selected";} ?> value='onlyme' >Only me</option>
                </select>
              </td>
            </tr>

            <tr>
              <td class="labels">Country</td>
              <td>
                <select class="text_input w_ti_200px" name="country">
                  <option <?php if(strcmp($privacy['country'], "public")==0){echo "selected";} ?> value='public' >Public</option>
                  <option <?php if(strcmp($privacy['country'], "onlyme")==0){echo "selected";} ?> value='onlyme' >Only me</option>
                </select>
              </td>
            </tr>

            <tr>
              <td class="labels">Joined date</td>
              <td>
                <select class="text_input w_ti_200px" name="join_date">
                  <option <?php if(strcmp($privacy['join_date'], "public")==0){echo "selected";} ?> value='public' >Public</option>
                  <option <?php if(strcmp($privacy['join_date'], "onlyme")==0){echo "selected";} ?> value='onlyme' >Only me</option>
                </select>
              </td>
            </tr>

            <tr>
              <td colspan="2" align="center"><input  class="default_btn w_btn_180px" type="submit" name="save_privacy" value="Save"></td>
            </tr>

        </form>

      </table>


       </div>
  </div>
  
</div>



<div class="row">

  <!--Change password-->
  <div class="col-md-12">
       <div class="s_menu4 bgtheme"><h3>Change password</h3></div>

       <div class="s4">
          
          <table class="profile_setting">

            <form action="setting.php" method="post">
                    
                  <tr>
                    <td colspan="2"><input  class="text_input w_ti_412px" type="password" name="current_pwd" placeholder="Current password" required></td>
                  </tr>

                  <tr>
                    <td colspan="2"><input  class="text_input w_ti_412px" type="password" name="new_pwd" placeholder="New password" required></td>
                  </tr>

                  <tr>
                    <td colspan="2"><input  class="text_input w_ti_412px" type="password" name="confirm_pwd" placeholder="Confirm password" required></td>
                  </tr>

                  <tr>
                        <td colspan="2" align="center"><input class="default_btn w_btn_180px" type="submit" name="change" value="Change"></td>
                  </tr>

            </form>

          </table>
       </div>
  </div>
  
</div>


<div class="row">

  <!--Themes and apperance-->
  <div class="col-md-12">
       <div class="s_menu5 bgtheme"><h3>Themes and apperance</h3></div>

       <div class="s5">
           
        <table class="profile_setting">      

        <form action="setting.php" method="post" enctype="multipart/form-data">

            <tr>
              <td class="labels">Select image</td><td colspan="2"><input type="file" name="theme_image" value="Browse" class="file_chooser form-control"></td>
            </tr>

            <tr>
              <td colspan="2" align="center"><input class="default_btn w_btn_180px" type="submit" name="set_theme" value="Set image as theme"></td>
            </tr>
        </form>

      </table>

       </div>
  </div>
  
</div>


</center>

    <!--div class="row">
      
      <div class="col-md-6">



        <table align="center" class="profile_setting">

        	<form action="settings.html" method="post" >

        	<tr><th colspan="2"><center>Edit Profile</center></th></tr>
        	<tr>
        		<td colspan="2" align="center"><img src="img/dp.png" alt="Profile image" width="200px" height="200px"></td>
        	</tr>
            
            <tr>
                <td><input type="file" name="profile_image" value="Browse" class="file_chooser form-control"></td>
                <td>
                	<input type="submit" name="upload" value="Upload"  class="default_btn w_btn_100px">
                	<input type="reset" name="discard" value="Discard"  class="default_btn w_btn_100px">
                </td>
            </tr>
          </form>
          
          </table>


        <table  align="center" class="profile_setting">

          <form action="settings.html" method="post">

            <tr><th colspan="2"><center>Personal infomations</center></th></tr>

            <form action="setting.html" method="post">
            <tr>
                    <td><input   class="text_input w_ti_200px" type="text" name="f_name" placeholder="First name" required></td>
                        <td><input  class="text_input w_ti_200px" type="text" name="l_name" placeholder="Last name" required></td>
                    </tr>

							<tr>
								<td colspan="2"><input class="text_input w_ti_412px" type="email" name="email" placeholder="Email" required></td>
							</tr>

							<tr>
								<td colspan="2"><input class="text_input w_ti_412px" type="text" name="phone" placeholder="phone" required></td>
							</tr>


							<tr>
                                <td> <div class="lable_dob">Birth of date</div> </td>
								<td><input class="text_input w_ti_200px" type="date" name="dob" placeholder="Date of birth"  required></td>
							</tr>

							<tr>
                                <td> <div class="lable_gender">Gender</div> </td>
								<td>
                                    <div class="gender_class">
          
                                        <label class="label_select">
                                            <input name="gender" type="radio"  value="male"/>
                                            <span>Male</span>
                                        </label>
                                        <label class="label_select">
                                            <input name="gender" type="radio"  value="female" />
                                            <span>Female</span>
                                        </label>
                                        
                                    </div>
                                    
                                </td>
							</tr>

							<tr>
								<td colspan="2"><input  class="text_input w_ti_412px" type="text" name="city" placeholder="City" required></td>
							</tr>

							<tr>
								<td colspan="2"><input  class="text_input w_ti_412px" type="text" name="country" placeholder="Country" required></td>
							</tr>

							<tr>
								<td colspan="2" align="center"><input  class="default_btn w_btn_180px" type="submit" name="save" value="Save"></td>
							</tr>
          		</form>

        </table>
                
        
      </div>



      <div class="col-md-6">
      	

      	<table  align="center" class="profile_setting">

          <form action="settings.html" method="post">
      		<tr>
      			<th colspan="2"><center>privacy and security setting</center></th>
      		</tr>

      		<tr>
      			<td class="labels">Phone</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>Public</option>
      					<option>Only me</option>
      				</select>
      			</td>
      		</tr>

      		<tr>
      			<td class="labels">Email</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>Public</option>
      					<option>Only me</option>
      				</select>
      			</td>
      		</tr>


      		<tr>
      			<td class="labels">Birthday</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>With year</option>
      					<option>Month and day</option>
      				</select>
      			</td>
      		</tr>

      		<tr>
      			<td class="labels">City</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>Public</option>
      					<option>Only me</option>
      				</select>
      			</td>
      		</tr>

      		<tr>
      			<td class="labels">Country</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>Public</option>
      					<option>Only me</option>
      				</select>
      			</td>
      		</tr>

      		<tr>
      			<td class="labels">Joined date</td>
      			<td>
      				<select class="text_input w_ti_200px">
      					<option>Public</option>
      					<option>Only me</option>
      				</select>
      			</td>
      		</tr>

      		<tr>
      			<td colspan="2" align="center"><input  class="default_btn w_btn_180px" type="submit" name="save" value="Save"></td>
          </tr>

      </form>

    </table>




  <table  align="center" class="profile_setting">

    <form action="settings.html" method="post">
            <tr>
        			<th colspan="2"><center>Change password</center></th>
        		</tr>

          		<tr>
    				<td colspan="2"><input  class="text_input w_ti_412px" type="text" name="current_pwd" placeholder="Current password" required></td>
    			</tr>

    			<tr>
    				<td colspan="2"><input  class="text_input w_ti_412px" type="text" name="new_pwd" placeholder="New password" required></td>
    			</tr>

    			<tr>
    				<td colspan="2"><input  class="text_input w_ti_412px" type="text" name="confirm_pwd" placeholder="Confirm password" required></td>
    			</tr>

    			<tr>
          			<td colspan="2" align="center"><input class="default_btn w_btn_180px" type="submit" name="change" value="Change"></td>
          </tr>

    </form>

  </table>


    <table  align="center" class="profile_setting">      

        <form action="settings.html" method="post">
            <tr>
              <th colspan="2"><center>Themes and apperance</center></th>
            </tr>

            <tr>
              <td class="labels">Select image</td><td colspan="2"><input type="file" name="profile_image" value="Browse" class="file_chooser form-control"></td>
            </tr>

            <tr>
              <td colspan="2" align="center"><input class="default_btn w_btn_180px" type="submit" name="set_theme" value="Set image as theme"></td>
            </tr>
        </form>

      </table>

     
      </div>
        
</div-->

</body>

</html>