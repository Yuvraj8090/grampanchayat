
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
            <form action="#" method="post">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:160px;font-size:30px;">मुख्य तथ्य</legend>
                    <span class="control-label col-lg-4" style="font-size:20px;">मुख्य तथ्य:</span><input type="text" name="facts" class="form-control" style="width:60%;" placeholder="मुख्य तथ्य"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;"> संख्या:</span> <input type="text" name="number" class="form-control" style="width:60%;"> <br/><br/>
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
    $facts = mysqli_real_escape_string($con, $_REQUEST['facts']);
    $number = mysqli_real_escape_string($con, $_REQUEST['number']);
       
    $insert = "INSERT INTO key_facts (facts, numbers, ddelete) VALUES ('$facts', '$number', '0')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
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
