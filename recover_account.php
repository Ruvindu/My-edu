<!doctype html>

<?php 
    require_once('inc\connection.php');
    require ('inc\PHPMailerAutoload.php');
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

    <link rel="shortcut icon" type="image/x-icon" href="img/logo-mini.png" />
    <title>My-edu</title>
      
  </head>



<body> 
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-7 left_main bgimg3">
				
				<h1>Join and share your<br>knowledge with others</h1>
				<h4>Education is the most powerful weapon<br>which you can use to change the world.</h4>


				<address class="copyrights">Copyrights &copy; 2019 my-edu.org</address>
			</div>
			<div class="col-md-5 right_main">
				<div class="logo_panel">
					<img src="img/logo-mini.png" alt="logo" width="45px" height="45px">
					<h2>My-edu</h2>
				</div>

				<div class="recover_panel">
					<form action=recover_account.php method="post" align="center">
						
					<table align="center">

						<tr><th colspan="2">Recover your account</th></tr>

						<?php 
						
							//var_dump($_POST);


							if (!isset($_POST['send']) && !isset($_POST['recover'])  && !isset($_POST['reset_pwd'])){ 
								
								// Generating a random number 
							    $randomNumber = rand(1589,9875);


								echo "<tr><td colspan=\"2\"> <input type='hidden' name='vcode' value={$randomNumber} > <input class=\"text_input w_ti_300px\" type=\"text\" name=\"usermail\" placeholder=\"Email\"></td></tr>";

								echo "<tr><td colspan=\"2\"><input class=\"default_btn w_btn_200px\" type=\"submit\" name=\"send\" value=\"Send verification code\"></td></tr>";

							}else if(isset($_POST['send']) && !isset($_POST['recover'])){

								$send_to = $_POST['usermail'];
								$vcode = $_POST['vcode'];
 
								/* send verification code to user email and check it is available in database */


									 $credential = include('inc/credential.php');   //credentials import

							                $mail = new PHPMailer;

							                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

							                $mail->isSMTP();                                      // Set mailer to use SMTP
							                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
							                $mail->SMTPAuth = true;                               // Enable SMTP authentication
							                $mail->Username = $credential['user'];           // SMTP username
							                $mail->Password = $credential['pass'];                           // SMTP password
							                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							                $mail->Port = 587;                                    // TCP port to connect to

							                $mail->setFrom("rmemail95@gmail.com");
							                $mail->addAddress($send_to);             // Name is optional

							                $mail->addReplyTo('My-edu');
							                //$mail->addCC('cc@example.com');
							                //$mail->addBCC('bcc@example.com');

							                //$mail->addAttachment('a.txt');         // Add attachments
							                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

							                $mail->isHTML(true);                                  // Set email format to HTML
							                $send1="";
							                $send2="";
							                //$pwd="Your password is : ".$_SESSION['password'];
							                
							                $mail->Subject = "My-edu password recover";
							                $mail->Body    = "Your verification code - $vcode<br><br>$send1<br><br>$send2";
							                $mail->AltBody = 'If you see this mail. please reload the page.';

							                if(!$mail->send()) {
							                    echo '<font color=red>Message could not be sent.</font>';
							                    echo "<font color=red>'Mailer Error: ' . {$mail->ErrorInfo}</font>";
							                } else {
							                    echo "<script>alert('verification code has been sent your email.')</script>";
							                }
							          


								echo "<tr><td colspan=\"2\" style=\"padding-top: 40px\"> <input type='hidden' name='vcode' value={$vcode} > <input type='hidden' name='recov_email' value={$send_to} > <input class=\"text_input w_ti_300px\" type=\"text\" name=\"verification_code\" placeholder=\"Enter verification code\"></td>";
								echo "<tr><td colspan=\"2\"><input class=\"default_btn w_btn_200px\" type=\"submit\" name=\"recover\" value=\"Recover\"></td></tr>";
								                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
							}else if(isset($_POST['recover'])){

								$vcode = $_POST['vcode'];

								/* verifiy  */

								if (strcmp($_POST['verification_code'],$vcode)==0) {
									
									/*Reset pwd*/
									reset_pwd();
									

								}else{

									echo "<tr><td colspan=\"2\" style=\"padding-top: 40px\"> <input type='hidden' name='vcode' value={$vcode} > <input type='hidden' name='recov_email' value={$_POST['recov_email']} > <input class=\"text_input w_ti_300px\" type=\"text\" name=\"verification_code\" placeholder=\"Enter verification code\"></td>";
									echo "<tr><td colspan=\"2\"><input class=\"default_btn w_btn_200px\" type=\"submit\" name=\"recover\" value=\"Recover\"></td></tr>";


									echo "<tr><td colspan=\"2\"><p style='color:red'>Incorrect verification code!</p></td></tr>";
								}

								                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
							}else if (isset($_POST['reset_pwd'])) {														

								if (strcmp($_POST['new_pwd'], $_POST['confirm_pwd'])==0) {                                                                                                                	
									if (strlen($_POST['confirm_pwd'])>=8) {
										/*Change pwd*/

										$new_pwd = sha1($_POST['confirm_pwd']);
										$update_pwd = "UPDATE `user` SET `password`= '{$new_pwd}' WHERE `email` = '{$_POST['recov_email']}'";

										
 				   						$pwd_chnge_resultset = mysqli_query($con,$update_pwd);

 				   						if ($pwd_chnge_resultset) {
 				   							echo "<script>alert('Password changed.');</script>";
 				   							header("location:index.php");
 				   						}

										


									}else{
										echo "<script>alert('Password must contain 8 characters.');</script>";
										reset_pwd();
									}
								}else{
									echo "<script>alert('Password not equal.');</script>";
									reset_pwd();
								}
							}


								
							function reset_pwd(){

								echo "<input type='hidden' name='recov_email' value={$_POST['recov_email']} >";
								echo "<tr><td colspan=\"2\"><input class=\"text_input w_ti_300px\" type=\"password\" name=\"new_pwd\" placeholder=\"New password\"></td></tr>";
								echo "<tr><td colspan=\"2\"><input class=\"text_input w_ti_300px\" type=\"password\" name=\"confirm_pwd\" placeholder=\"Confirm password\"></td></tr>";
								echo "<tr><td colspan=\"2\"><input class=\"default_btn w_btn_200px\" type=\"submit\" name=\"reset_pwd\" value=\"Reset password\"></td></tr>";	

							}


						 ?>


						
						</table>

					</form>
				</div>


			</div>
		</div>

		
			
		
	</div>


</body>


</html>
    