<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	<div class="left_box">
        <?php 
            include 'conn.php' ;
            mysqli_set_charset( $con, 'utf8');

            $sql="SELECT id, title, url, about FROM video ORDER BY id DESC LIMIT 10";
            $result= mysqli_query($con, $sql);
            $rowcount=mysqli_num_rows($result);

            if($rowcount)
            {
                $result= mysqli_query($con, $sql);
                            
                while($row=mysqli_fetch_assoc($result))                              
                {                          
                                     
                   echo "<h2>".$row['title']."</h2>";
                   echo "<iframe width='100%' height='300px' src='".$row['url']."' frameborder='0' allowfullscreen></iframe>";
                    echo "<p>".$row['about']."</p><br/>";        
                } 
            }
            else
            {
                echo "<span style='font-weight:bold;'><center>no record</center></span>";
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