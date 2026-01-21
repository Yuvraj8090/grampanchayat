<?php 
  include 'header.php';
?>

<br/>
<div class="body">
  <div class="left_box">
    
   
       <?php 
             $connect = mysqli_connect("localhost", "grampanc_wp390", "p2Sn5G0.]0", "grampanc_wp390");
             mysqli_set_charset( $connect, 'utf8');
             $ID= $_REQUEST['ID'];
                $sql = "SELECT ID, post_date, post_title, post_content FROM wpbq_posts WHERE ID = '$ID'";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) 
                    {
                        if($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<div style='width:auto;color:blue;font-weight:bold;font-size:25px;'>".$row['post_title']."</div>";
                            echo "<p style='font-weight:bold;'>".$row['post_date']."</p>";
                            echo "<div class='matter'>".$row['post_content']."</div>";
                        }
                    }
                else
                {
                    echo "<span style='font-weight:bold;'><center>No Records</center></span>";
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