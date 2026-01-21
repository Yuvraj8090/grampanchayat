<?php 
        session_start();
     $_SESSION["project"];

        if (empty($_SESSION["project"])) 
        {
            header("Location:index.php");
        }
    ?>
<?php  
    include 'header.php';
?>
<?php  
    include 'menu.php';
?>

<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;padding-top:10px;">
        <div class="main">
            <form action="add_videos.php">
                <button>Add New Video</button>
            </form>
                <div class="table">
                    
                      <?php 
                      include 'conn.php' ;
                      mysqli_set_charset( $con, 'utf8');

                      $sql="SELECT id, title, url, about FROM video WHERE ddelete = 0";
                      $result= mysqli_query($con, $sql);
                       $rowcount=mysqli_num_rows($result);


                      if($rowcount)
                        {
                            $result= mysqli_query($con, $sql);
                              
                            echo '<table border="1px" width="auto%" cellpadding="10px">';
                            echo '<tr style="font-weight:bold;font-size:18px;"><td>क्रमांक</td><td>Title </td><td>Operations</td></tr>';

                               $i=1;
                              while($row=mysqli_fetch_assoc($result))                              
                              {
                               
                          
                                  echo '<tr><td>'.$i.'</td><td>'.$row["title"].'</td><td><a href="vedit.php?id='.$row["id"].'">edit</a> | <a href="vdelete.php?id='.$row["id"].'">delete</a></td></tr>';
                                  $i++;
                                
                              } 


                        }
                    else
                          {
                               echo "<span style='font-weight:bold;'><center>no record found please click on add new Record Button</center></span>";

                        }

                    echo '</table>'
                    ?>
                </div>
        </div>
    </div>
</div>
<!--END PAGE CONTENT -->
<?php  
    include 'banner.php';
?>
    </div>

    <!--END MAIN WRAPPER -->

<?php  
    include 'footer.php';
?>


    <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.time.js"></script>
     <script  src="assets/plugins/flot/jquery.flot.stack.js"></script>
    <script src="assets/js/for_index.js"></script>
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>
