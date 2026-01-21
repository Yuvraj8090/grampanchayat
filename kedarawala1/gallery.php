<?php 
	include 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css">
<br/>
<div class="body">
	<div class="left_box">
		<div class="heading">ग्राम पंचायत की फोटो गैलरी </div>
		<br/>
		<div class="table">
			 <?php 
            include 'conn.php';
             mysqli_set_charset( $con, 'utf8');
                $sql = "SELECT gallery,alt FROM gallery WHERE ddelete = 0";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<a href='admin/".$row['gallery']."' target='_blank' data-lightbox='galery'><img src='admin/".$row['gallery']."' border='0' height='150' width='150' alt='".$row['alt']."' title='".$row['alt']."' style='border:1px solid #ccc;padding:5px;margin-left:4px;'></a>";
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
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox-plus-jquery.min.js"></script>
<?php 
	include 'rightbox.php';
?>
<div class="clear"></div>
</div>
<?php 
	include 'footer.php';
?>