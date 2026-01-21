
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
 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<div id="content">
    <div class="inner" style="min-height: 700px;padding-top:10px;">
        <div class="main">       
            <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:160px;font-size:30px;">प्रधान सन्देश</legend>
					<span class="control-label col-lg-4" style="font-size:20px;">Choose File:</span><input type="file" name="pmphoto" style="margin-left:20px;"><br/>
					<textarea rows="10" name="message"></textarea><br/>
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
    
	$message = mysqli_real_escape_string($con, $_REQUEST['message']);
	$pmphoto = $_FILES["pmphoto"]["name"];
    $path = "gallery/";
    $pmphoto = $path.$_FILES["pmphoto"]["name"];
       
    $insert = "INSERT INTO pradhan_message (message, pmphoto, ddelete) VALUES ('$message', '$pmphoto', '0')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
		move_uploaded_file($_FILES["pmphoto"]["tmp_name"], $pmphoto);
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
