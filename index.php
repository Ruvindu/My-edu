<!doctype html>


<?php 

	session_start(); 
	require_once('inc\connection.php');
	

	/* IF YOU LOGGED IN REDIRECT TO HOME PAGE */

	if ( isset($_SESSION['s_id']) && 13==count($_SESSION) ) {
	    header("location:home.php");
	}


	$flag = '';

	if (isset($_POST['login'])) {

		/* PREPAERING DATA TO LOGIN */

		$email_or_phone =  mysqli_real_escape_string($con,trim($_POST['username']));
		$pwd = mysqli_real_escape_string($con,trim($_POST['password']));
		$h_pwd = sha1($pwd);
					
		$user_qurey = "SELECT * FROM `user` WHERE   `password` = '$h_pwd ' AND  (`phone` = '$email_or_phone' OR `email` = '$email_or_phone') LIMIT 1";

		/* FINDE USERS */

		$result_set = mysqli_query($con,$user_qurey);

		if (mysqli_num_rows($result_set)==1) {
			$user_details = mysqli_fetch_assoc($result_set);


			/* IS SET REMEMBER ME*/

			/*if (isset($_POST['remember_me']) {
				echo "rememberd";
			}*/

			/* IF USER AVAILABLE SET SESSIONS AS 1 ARRAY VARIABLE*/

			$_SESSION = array();
			$_SESSION = $user_details;

			/* REDIRACT TO LOADING PAGE */

			header("location:load.php");
		}
		else{
			$flag = "Incorrect email or password.";
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
    
    <link rel="stylesheet" type="text/css" href="css/default_style.css">
    <link rel="stylesheet" type="text/css" href="css/animations.css">

    <script src="js/bootstrap.min.js"></script>
    <!--script src="js/setting.js" type="text/javascript"></script-->

    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    <title>My-edu</title>
      
  </head>



<body> 
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-7 left_main bgimg1" >
				
				<h1>Join and share your<br>knowledge with others</h1>
				<h4>Education is the most powerful weapon<br>which you can use to change the world.</h4>


				<address class="copyrights">Copyrights &copy; 2019 my-edu.org</address>
			</div>
			<div class="col-md-5 right-main">
				<div class="logo_panel">
					<img src="img/logo-mini.png" alt="logo" width="45px" height="45px">
					<h2>My-edu</h2>
				</div>

				<div class="login_panel">
					<form action=index.php method="post" align="center">
						
						<table align="center">
							<tr><th colspan="2">Login as a student</th></tr>
							<tr><td colspan="2"><img src="img/Graduation-Icon.png" alt="Graduation-Icon" width="120px" height="120px"></td></tr>

							<tr><td colspan="2"><input class="text_input w_ti_280px" type="text" name="username" placeholder="Email or phone" required ></td></tr>
							<tr><td colspan="2"><input class="text_input w_ti_280px" type="password" name="password" placeholder="Password" required ></td></tr>
							<tr>
								<td><input class="default_btn w_btn_120px" type="reset" name="clear" value="Clear"></td>
								<td><input class="default_btn w_btn_120px" type="submit" name="login" value="Login"></td>
							</tr>

							<tr><td colspan="2"><input type="checkbox" name="remember_me" value="1">Remember me</td></tr>

							<tr><td colspan="2" class="forgot_pwd"><a href="recover_account.php">Forgotten password</a></tr>

							<tr>
								<td colspan="2" class="reg"> 
									<div>
										<a href="register.php">Register as a student</a>
									</div>
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<br>
									<?php 
										if($flag!=''){
											echo "<p style='color:#f00; margin-bottom:10px'>{$flag}</P>";		
										}
									?>
								</td>
							</tr>
						</table>

					</form>
				</div>


			</div>
		</div>

		
			
		
	</div>


</body>


</html>
    

