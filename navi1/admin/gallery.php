<head>
    <title> विकास कार्य</title>
</head>
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
    <div class="inner" style="min-height: 700px;padding:40px;">
      <form action="add image.php">
       <button>Upload New Image</button>
       </form>
       <div class="main">
           <?php 
            include 'conn.php';
             mysqli_set_charset( $con, 'utf8');
                $sql = "SELECT id, gallery, alt FROM gallery Where ddelete=0";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) 
                    {
                         echo '<table border="1px" width="auto%" cellpadding="10px">';
                         echo '<tr style="font-weight:bold;font-size:18px;"><td>क्रमांक</td><td>Photo</td><td>Discription</td><td>Operations</td></tr>';

                               $i=1;
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                             echo '<tr><td>'.$i.'</td><td><a href="' . $row['gallery'] . '"><img src="' . $row['gallery'] . '" alt="no image"height="150px" width="150px"/></a></td><td>'.$row["alt"].'</td></td><td><a href="photoedit.php?id='.$row["id"].'">edit</a> | <a href="photodelete.php?id='.$row["id"].'">delete</a></td></tr>';
                                  $i++;
                        } 
                    }
                else
                {
                    echo "<span style='font-weight:bold;'><center>No Images</center></span>";
                }
                echo "</table>";
?>
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




 
