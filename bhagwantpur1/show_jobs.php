<?php 
  include 'header.php';
?>

<br/>
<div class="body">
  <div class="left_box">
    
   
       <?php 
            include 'conn.php';
             mysqli_set_charset( $con, 'utf8');
             $id= $_REQUEST['id'];
                $sql = "SELECT id, title, jobs FROM jobs WHERE id = '$id'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) 
                    {
                        if($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<div class='heading' style='width:auto;background-color:orange;'>".$row['title']."</div>";
                            echo "<div class='matter'>".$row['jobs']."</div>";
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