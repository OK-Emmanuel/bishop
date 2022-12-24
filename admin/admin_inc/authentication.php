<?php 

if (!isset($_SESSION['auth'])) {
	$_SESSION['ErrorMessage'] = "Login to Access Dashboard";
	header("Location: login.php");
	exit(0);
}


 ?>