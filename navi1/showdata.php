<?php 
	include 'header.php';
?>
<br/>
<?php 
	include("conn.php");
	mysqli_set_charset( $con, 'utf8');
	$id=mysqli_real_escape_string($con, $_REQUEST['id']);
	$sql = "SELECT  id, dworkname, about_work, plan_name, year, price, progress_status FROM development_works where id='$id' ";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
 		    $dworkname=$row["dworkname"];
 		    $id=$row["id"];
 		    $about_work=$row["about_work"];  
  		    $plan_name=$row["plan_name"];
  		    $year=$row["year"];
  		    $price=$row["price"];
  			$progress_status=$row["progress_status"];
 		} 
	}
?>
<div class="body">
	<table width="100%" class="show_table">
		<tr>
			<td style="width:15%;padding-left:10px;padding-top:20px;">ID:</td>
			<td><input type="text" value="<?php echo $id; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">कार्य का नाम:</td>
			<td><input type="text" value="<?php echo $dworkname; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">कार्य के बारेमे:</td>
			<td><input type="text" value="<?php echo $about_work; ?>" readonly="readonly"></td>
		</tr>
		<?php 
     		include 'conn.php';
     		mysqli_set_charset( $con, 'utf8');
			$id=mysqli_real_escape_string($con, $_REQUEST['id']);
			$sql = "SELECT oldphotos, newphotos FROM development_works where id='$id' ";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$newphoto = $row['newphotos'];
					$oldphoto = $row['oldphotos'];

					if ($newphoto== true && $oldphoto== true) 
					{
					echo '<tr><td style="padding-left:10px;padding-top:20px;">पुराणी फोटो:</td><td><a href="admin/'.$row['oldphotos'].'"><img src="admin/'.$row['oldphotos'].'" height="150px" width="150px" style="margin-left:20px;margin-top:20px;"/></a></td></tr>';
   					echo '<tr><td style="padding-left:10px;padding-top:20px;">नए फोटो:</td><td><a href="admin/' . $row['newphotos'] . '"><img src="admin/' . $row['newphotos'] . '"height="150px" width="150px" style="margin-left:20px;"/></a></td></tr>';
					}
					else
					{
						echo '<tr><td style="padding-left:10px;padding-top:20px;">पुराणी फोटो:</td><td><img src="gallery/no.png" height="150px" width="150px" style="margin-left:20px;margin-top:20px;"/></td></tr>';
   					echo '<tr><td style="padding-left:10px;padding-top:20px;">नए फोटो:</td><td><img src="gallery/no.png" height="150px" width="150px" style="margin-left:20px;"/></td></tr>';
					}
  					
  				} 
			}
		?>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">योजना का नाम:</td>
			<td><input type="text" value="<?php echo $plan_name; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">वर्ष दिनक:</td>
			<td><input type="text" value="<?php echo $year; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">राशि:</td>
			<td><input type="text" value="<?php echo $price; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">स्तीथि:</td>
			<td><input type="text" value="<?php echo $progress_status; ?>" readonly="readonly"></td>
		</tr>
	</table><br/>
</div>
<?php 
	include 'footer.php';
?>