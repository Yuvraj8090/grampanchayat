<?php 
	 $username = $_POST["username"];
	$password = $_POST["password"];
	$place = $_POST['place'];
	include('conn.php');
	$match = "SELECT username, password, designation From login Where username='$username' and password='$password'";
	$q=mysqli_query($con,$match);
	
	$query = mysqli_fetch_assoc($q);

 	$dusername=$query['username'];
 	$dpassword=$query['password'];
 	$designation=$query['designation'];
if($username==$dusername && $password==$dpassword)
{
	session_start();
	$_SESSION['project']=$dusername;
	header("Location:dashboard.php");
}
else
{
	echo "<span style='color:red;font-family:arial;font-size:40px;font-weight:bold;line-height:600px;'><center>Wrong Username OR Password</center></span>";

}

?>
