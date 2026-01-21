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
        <a href="vibhag_karya.php">Go Back</a>
        <div class="main">       
            <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:142px;font-size:30px;">विभाग कार्य</legend>
                    <span class="control-label col-lg-4" style="font-size:20px;">ईयर:</span><input type="text" name="year" class="form-control" style="width:60%;" placeholder="ईयर" required="required"><br/><br/>
                    
                    <span class="control-label col-lg-4" style="font-size:20px;">विभाग कार्य का नाम :</span> <input type="text" name="name" class="form-control" style="width:60%;" placeholder="विभाग कार्य का नाम " required=""><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">डिस्क्रिप्शन  :</span><textarea cols="25px" rows="4" style="width:60%;" class="form-control" name="description" required="required" placeholder="डिस्क्रिप्शन "></textarea><br/><br/><br/>
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
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
   
   
   
     $insert = "INSERT INTO vibhag_karya (year, name, description, ddelete) VALUES ('$year', '$name', '$description', '0')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
        echo "<script>alert ('Added Successfully')</script>";
    }
    else
    {
        echo "<script>alert ('Not Added')</script>";
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
