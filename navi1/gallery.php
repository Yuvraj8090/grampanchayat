<?php 
	include 'header.php';
?>

<br/>
<div class="body">
	<div class="left_box">
		<div class="heading">ग्राम पंचायत की फोटो गैलरी </div>
		<br/>
		<div class="table">
			 <?php 
            include 'conn.php';
             mysqli_set_charset( $con, 'utf8');
                $sql = "SELECT gallery,alt FROM gallery";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<a href='admin/".$row['gallery']."'><img src='admin/".$row['gallery']."' border='0' height='150' width='150' alt='".$row['alt']."' title='".$row['alt']."' style='border:1px solid #ccc;padding:5px;margin-left:4px;'></a>";
                        }
                    }
                else
                {
                    echo "<span style='font-weight:bold;'><center>No Images</center></span>";
                }


        
        
            
        
?>
</ul>
		</div>
	</div>
<?php 
	include 'rightbox.php';
?>
<div class="clear"></div>
</div>
<?php 
	include 'footer.php';
?>