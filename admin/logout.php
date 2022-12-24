<?php 
session_start();
unset($_SESSION['auth']);
unset($_SESSION['auth_role']);
unset($_SESSION['auth_user']);

$_SESSION["SuccessMessage"] = "Logged Out Successfully";
header("Location: login.php");
exit(0);
?>