<?php 
	include 'header.php';
?>
<br/>
<?php 
	include("conn.php");
	mysqli_set_charset( $con, 'utf8');
	$id=mysqli_real_escape_string($con, $_REQUEST['id']);
	$sql = "SELECT  id, jname, position, block, phone_number FROM janparthinidhi where id='$id' ";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
     		$jname=$row["jname"];
     		$id=$row["id"];
     		$position=$row["position"];  
     		$block=$row["block"];
     		$phone_number=$row["phone_number"]; 
  		} 
	}
?>
<div class="body">
	<table width="100%" class="show_table">
		<tr>
			<td style="width:15%;padding-left:10px;padding-top:20px;">ID:</td>
			<td><input type="text" value="<?php echo $id; ?>" readonly="readonly"></td>
		</tr>
		<?php 
     		include 'conn.php';
			$id=mysqli_real_escape_string($con, $_REQUEST['id']);
			$sql = "SELECT janphoto FROM janparthinidhi where id='$id' ";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
  				   echo '<tr><td style="padding-left:10px;padding-top:20px;">फोटो:</td><td><a href="admin/' . $row['janphoto'] . '"><img src="admin/' . $row['janphoto'] . '" alt="no image" height="150px" width="150px" style="margin-left:20px;margin-top:20px;"/></a></td></tr>';
     			} 
			}
		?>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">नाम:</td>
			<td><input type="text" value="<?php echo $jname; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">पद:</td>
			<td><input type="text" value="<?php echo $position; ?>" readonly="readonly"></td>
		</tr>
		
		<tr>
			<td style="padding-left:10px;padding-top:20px;">वार्ड:</td>
			<td><input type="text" value="<?php echo $block; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td style="padding-left:10px;padding-top:20px;">फ़ोन नंबर:</td>
			<td><input type="text" value="<?php echo $phone_number; ?>" readonly="readonly"></td>
		</tr>
	</table><br/>
</div>
<?php 
	include 'footer.php';
?>