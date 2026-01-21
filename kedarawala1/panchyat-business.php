<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	<div class="heading" style="background-color:#FB9943;text-align:center;">ग्राम पंचायत में चल रहे मुख्य व्यवसाय </div>
    <div class="matter">
       <?php 
            include 'conn.php' ;
            mysqli_set_charset( $con, 'utf8');

            $sql="SELECT id, intro FROM business_intro";
            $result= mysqli_query($con, $sql);
            $rowcount=mysqli_num_rows($result);

            if($rowcount)
            {
                $result= mysqli_query($con, $sql);
                              
                                 
                while($row=mysqli_fetch_assoc($result))                              
                {                          
                    echo $row["intro"];
                } 
            }
            else
            {
                echo "<span style='font-weight:bold;'><center>no record</center></span>";
            }
       ?>
    </div><br/><br/>
    <?php 
            include 'conn.php' ;
                                mysqli_set_charset( $con, 'utf8');

                                $sql="SELECT id, name, about, image FROM business WHERE ddelete = 0 ORDER BY id ASC";
                                $result= mysqli_query($con, $sql);
                                $rowcount=mysqli_num_rows($result);


                                if($rowcount)
                                 {
                                    $result= mysqli_query($con, $sql);
                              
                                    
                                    while($row=mysqli_fetch_assoc($result))                              
                                    {                          
                                        
                                        echo "<div class='img'><a href='".$row['image']."'><img src='admin/".$row['image']."' width='200px'></a></div>";
                                        echo "<div class='heading' style='float:left;width:40%;'>".$row['name']."</div><br/><br/>";
                                        echo " <div class='matter'>".$row['about']."</div>";
                                        echo "<div class='clear'></div><br/>";
                                        
                                    } 
                                }
                                else
                                {
                                   echo "<span style='font-weight:bold;'><center>no record</center></span>";

                                  }
       ?>
    
</div>
<?php 
	include 'footer.php';
?>