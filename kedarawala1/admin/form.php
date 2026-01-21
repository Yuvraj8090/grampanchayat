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
    <div class="inner" style="min-height: 700px;padding-top:10px;">
        <div class="main">       
            <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:142px;font-size:30px;">विकास कार्य</legend>
                    <span class="control-label col-lg-4" style="font-size:20px;">कार्य का नाम:</span><input type="text" name="dworkname" class="form-control" style="width:60%;" placeholder="कार्य का नाम" required="required"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">कार्य के बारेमे:</span><textarea cols="25px" rows="4" style="width:60%;" class="form-control" name="about_work" required="required"></textarea><br/><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">योजना का नाम:</span> <input type="text" name="plan_name" class="form-control" style="width:60%;" placeholder="योजना का नाम" required=""><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">वर्ष:</span> <input type="text" name="year" class="form-control" style="width:60%;" required=""> <br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">राशि:</span> <input type="text" name="price" class="form-control" style="width:60%;" required="required"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">स्तीथि:</span> <select name="progress_status" class="form-control" style="width:60%;" required="required">
                        <option></option><option>   प्रगतिशील</option><option>पूर्ण</option>
                    </select><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">पुराणी फोटो:</span> <input type="file" name="oldphotos" style="margin-left:80px;"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">नए फोटो:</span> <input type="file" name="newphotos" style="margin-left:78px;"><br/><br/>
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
    $dworkname = mysqli_real_escape_string($con, $_POST['dworkname']);
    $about_work = mysqli_real_escape_string($con, $_POST['about_work']);
    $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $progress_status = mysqli_real_escape_string($con, $_POST['progress_status']);
        $oldphotos = $_FILES["oldphotos"]["name"];
        $path = "oldphotos/";
        $oldphotos = $path.$_FILES["oldphotos"]["name"];

        $newphotos = $_FILES["newphotos"]["name"];
        $path = "newphotos/";
        $newphotos = $path.$_FILES["newphotos"]["name"];
   
   
     $insert = "INSERT INTO development_works (dworkname, about_work, plan_name, year, price, progress_status, oldphotos, newphotos, ddelete) VALUES ('$dworkname', '$about_work', '$plan_name', '$year', '$price', '$progress_status', '$oldphotos', '$newphotos', '0')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
        move_uploaded_file($_FILES["oldphotos"]["tmp_name"], $oldphotos);
        move_uploaded_file($_FILES["newphotos"]["tmp_name"], $newphotos);
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
