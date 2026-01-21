<?php 
	session_start();
	
	 $_SESSION["project"];
	session_unset();
	session_destroy(); 
	header('location:index.php');
	
?>