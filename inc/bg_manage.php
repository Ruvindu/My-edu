<?php


	echo "<style>";

	echo ".bgtheme{";
	echo "background: linear-gradient(to right, rgba(255, 255, 255, 1) 10% , rgba(0, 0, 0, .2)),url(\"{$_SESSION['s_theme']}\");";
	echo "background-repeat: no-repeat;";
	echo "background-size: cover;";
	echo "position: center;";
	echo "background-attachment: fixed;";
	echo "}";
	echo "</style>";


?>