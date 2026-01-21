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
    <a href="gallery.php">Go Back</a><br/><br/><br/>
    <form action="#" method="post" enctype="multipart/form-data">
    <span class="control-label col-lg-4" style="font-size:20px;">Image Discription:</span><input type="text" name="image_name"  class="form-control" style="width:60%;" required><br/><br/>
        <span class="control-label col-lg-4" style="font-size:20px;">Choose File:</span><input type="file" name="gallery" style="margin-left:20px;"><br/>
        <center><input type="submit" name="submit" value="submit"></center>
    </form>
    <?php  
        if (isset($_POST['submit'])) 
        {
            $image_name = $_POST['image_name'];
            $gallery = $_FILES["gallery"]["name"];
            $path = "gallery/";
            $gallery = $path.$_FILES["gallery"]["name"];

            include 'conn.php';
   
            $insert = "INSERT INTO gallery (gallery, alt) VALUES ('$gallery', '$image_name')";
             $add = mysqli_query($con, $insert);

             if ($add) 
             {
                move_uploaded_file($_FILES["gallery"]["tmp_name"], $gallery);
                echo "<span style='font-weight:bold;color:green;font-size:30px;'><center>Added Successfully</center></span>";
             }
             else
             {
                 echo "<span style='font-weight:bold;color:red;font-size:30px;'><center>Not Added</center></span>";
             }
        }
    ?>
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




 
