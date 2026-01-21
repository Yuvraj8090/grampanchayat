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
    <a href="address.php">Go Back</a><br/><br/><br/>
    <form action="#" method="post">
        <span class="control-label col-lg-4" style="font-size:20px;">पता:</span><textarea cols="30px" rows="6" name="address" placeholder="Address" class="form-control"></textarea><br/><br/>
        <center><input type="submit" name="submit" value="Submit"></center>
    </form>
    <?php  
        if (isset($_POST['submit'])) 
        {
            $address = $_POST['address'];
           

            include 'conn.php';
   
            $insert = "INSERT INTO address (address) VALUES ('$address')";
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




 
