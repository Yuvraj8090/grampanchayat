<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	<div class="heading" style="background-color:#FB9943;text-align:center;">ग्राम पंचायत के मुख्य स्थल और पर्यटक स्थल</div>
    <div class="matter">
         <?php 
            include 'conn.php' ;
            mysqli_set_charset( $con, 'utf8');

            $sql="SELECT id, intro FROM place_intro";
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

                                $sql="SELECT id, name, about, image FROM places ORDER BY id ASC";
                                $result= mysqli_query($con, $sql);
                                $rowcount=mysqli_num_rows($result);


                                if($rowcount)
                                 {
                                    $result= mysqli_query($con, $sql);
                              
                                    
                                    while($row=mysqli_fetch_assoc($result))                              
                                    {                          
                                        
                                        echo "<div class='img'><a href='admin/".$row['image']."'><img src='admin/".$row['image']."'></a></div>";
                                        echo "<div class='heading' style='float:left;width:40%;'>".$row['name']."</div><br/><br/>";
                                        echo " <div class='matter'>".$row['about']."</div>";
                                        echo "<div class='clear'></div>";
                                        
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
