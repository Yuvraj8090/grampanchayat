<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	<div class="left_box">
        <?php 
            include 'conn.php' ;
            mysqli_set_charset( $con, 'utf8');

            $sql="SELECT id, message, pmphoto FROM pradhan_message";
            $result= mysqli_query($con, $sql);
            $rowcount=mysqli_num_rows($result);

            if($rowcount)
            {
                $result= mysqli_query($con, $sql);
                         
                                    
                while($row=mysqli_fetch_assoc($result))                              
                {     
                    echo "<div class='img' style='border:none;'><br/><img src='admin/".$row['pmphoto']."' alt='no iamge' height='150px' width='140px'/></div>".$row['message'];                     
                } 
            }
            else
            {
                echo "<span style='font-weight:bold;'><center>no record found</center></span>";

            }
        ?>
	</div>
<?php 
	include 'rightbox.php';
?>
<div class="clear"></div>
</div>
<?php 
	include 'footer.php';
?>