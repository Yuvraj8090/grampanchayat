<?php

	if(isset($_POST)){
		
	if(  isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["message"]) ){
			
	$to = "info@pramodyadav.in"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = "Web Enquiry Form";
    $message =  "<table width='400px' >
			<tr><td colspan='2' align='center'><h2>Person Details</h2><td></tr>
			<tr><td width='200px'><span style='color:#4044e1; font-size:18px;'>Name : </span></td><td>".$_POST['name']."</td></tr>			
			<tr><td width='200px'><span style='color:#4044e1; font-size:18px;'>Email : </span></td><td>".$_POST['email']."</td></tr>
			<tr><td width='200px'><span style='color:#4044e1; font-size:18px;'>Mobile : </span></td><td>".$_POST['phone']."</td></tr>
			<tr><td width='200px'><span style='color:#4044e1; font-size:18px;'>Subject : </span></td><td>".$_POST['subject']."</td></tr>
			<tr><td width='200px'><span style='color:#4044e1; font-size:18px;'>Message : </span></td><td>".$_POST['message']."</td></tr>
			</table>";
    $message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['inputMessage'];
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= "From:" . $from;
    mail($to,$subject,$message,$headers);  
    echo "Thanks!! your request has been submitted";
		}else{
			echo "Something went wrong";
		}
		
	}else{
		echo "Something went wrong";
	}


?>