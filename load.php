<!doctype html>

<html lang="en">
  <head>

<?php 

    session_start(); 
    require_once('inc\connection.php');
    //var_dump($_SESSION);
    

    function gather_details($user_details)
    {
        $_SESSION  = array();

        $_SESSION['s_id'] = $user_details['id'];
        $_SESSION['s_fname'] = $user_details['f_name'];
        $_SESSION['s_lname'] = $user_details['l_name'];
        $_SESSION['s_email'] = $user_details['email'];
        $_SESSION['s_phone'] = $user_details['phone'];
        $_SESSION['s_dob'] = $user_details['dob'];
        $_SESSION['s_gender'] = $user_details['gender'];
        $_SESSION['s_city'] = $user_details['city'];
        $_SESSION['s_country'] = $user_details['country'];
        $_SESSION['s_picture'] = $user_details['picture'];
        $_SESSION['s_theme'] = $user_details['theme'];
        $_SESSION['s_joined'] = $user_details['joined'];

    }

    /*  CHECK USER IS VALID USER */

    if ( isset($_SESSION['s_id']) && 12==count($_SESSION)) {
        header("location:home.php");  
    }
    /* FIRST TIME LOGIN */
    elseif(3==count($_SESSION)){


        $user_qurey = "SELECT * FROM `user` WHERE `email` = '{$_SESSION['s_email']}' and `phone` = '{$_SESSION['s_phone']}' and `password` = '{$_SESSION['s_h_pwd']}'  LIMIT 1";


        $result_set = mysqli_query($con,$user_qurey);

           if(mysqli_num_rows($result_set) == 1){
                $user_details = mysqli_fetch_assoc($result_set);
                

                    $privacy_query = "INSERT INTO `privacy`(`user_id`, `phone`, `email`, `dob`, `city`, `country`, `join_date`) VALUES ({$user_details['id']}, 'public', 'public', 'full', 'public', 'public' ,'public')";
                    

                    $result_set = mysqli_query($con,$privacy_query);


                    /* create user folders */
                    mkdir("usr/{$user_details['id']}");
                    mkdir("usr/{$user_details['id']}/profile");
                    mkdir("usr/{$user_details['id']}/theme");
                    mkdir("usr/{$user_details['id']}/files");

                gather_details($user_details);

           }
           else{
                header("location:registerphp");
           }
    /* LOGIN */
    }
    elseif (isset($_SESSION['id']) && 13==count($_SESSION)) {
       gather_details($_SESSION);
    }
    else{
        header("location:index.php");
    }
    


 ?>

    <meta http-equiv='refresh' content='3.5;url=home.php' />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
    <!-- Main css styles-->
 
    <link rel="stylesheet" type="text/css" href="css/default_style.css">
    <link rel="stylesheet" type="text/css" href="css/animations.css">

    <script src="js/bootstrap.min.js"></script>
    <script src="js/load_settings.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    <title>My-edu</title>
      
  </head>



<body onload="resizing()" onresize="resizing()"> 
	
                <div id=load>
                    <div class="animate_logo">
                                <img src="img/logo-mini.png" alt="logo" width="50px" height="50px">
                                <h1>My-edu</h1>
                    </div>
                    <div class="progress-outer"><div class="progress-inner"></div></div>

                    <br>
              </div>
                
  

</body>
</html>

