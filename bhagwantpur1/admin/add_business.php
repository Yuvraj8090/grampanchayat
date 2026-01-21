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
            <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:250px;font-size:30px;">ग्राम्य व्यवसाय</legend>
                    <span class="control-label col-lg-4" style="font-size:20px;">नाम:</span><input type="text" name="name" class="form-control" style="width:60%;"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;"> बारे में:</span> <input type="text" name="about" class="form-control" style="width:60%;"> <br/><br/>
					<span class="control-label col-lg-4" style="font-size:20px;"> Choose File:</span> <input type="file" name="image" class="" style="width:60%;"> <br/><br/>
                    <input type="submit" name="submit" value="Submit" style="margin-left:350px;">
                    <input type="reset" name="reset">
                </fieldset>
            </form>
            </div>
            <?php  
if (isset($_POST['submit'])) 
{
    include 'conn.php';
     mysqli_set_charset( $con, 'utf8');
    $name = mysqli_real_escape_string($con, $_REQUEST['name']);
    $about = mysqli_real_escape_string($con, $_REQUEST['about']);
	$image = $_FILES["image"]["name"];
    $path = "gallery/";
    $image = $path.$_FILES["image"]["name"];
       
    $insert = "INSERT INTO business (name, about, image) VALUES ('$name', '$about', '$image')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
		move_uploaded_file($_FILES["image"]["tmp_name"], $image);
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
