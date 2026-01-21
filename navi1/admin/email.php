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
      <div class="mian">
        <form action="#" method="post" enctype="multipart/form-data">
          <span class="col-lg-4" style="font-size:20px;">To:</span><input type="text" name="send_to" style="width:60%;" class="form-control"><br/>
          <span class="col-lg-4" style="font-size:20px;">Subject:</span><input type="text" name="subject" style="width:60%;" class="form-control"><br/><br/>
          <span class="col-lg-4" style="font-size:20px;">Attachment:</span><input type="file" name="file"><br/><br/>
          <span class="col-lg-4" style="font-size:20px;">Message:</span><textarea cols="30px" rows="4" name="message" style="width:60%;" class="form-control"></textarea><br/><br/>
          <center><input type="submit" name="submit" value="Send"></center>
        </form>
        <?php  
          if (isset($_POST['submit'])) 
          {
            $send_to = $_POST['send_to'];
            $subject = $_POST['subject'];

            $file = $_FILES["file"]["name"];
            $path = "email/";
            $file = $path.$_FILES["file"]["name"];

            $message = $_POST['message'];

            include 'conn.php';

            $insert = "INSERT INTO email (send_to, subject, file, message) VALUES ('$send_to', '$subject', '$file', '$message')";
            $add = mysqli_query($con, $insert);

            if ($add) 
             {
                move_uploaded_file($_FILES["file"]["tmp_name"], $file);
                echo "<span style='font-weight:bold;color:green;font-size:30px;'><center>Mail Sent</center></span>";
              }
            else
            {
                echo "<span style='font-weight:bold;color:red;font-size:30px;'><center>Not Sent</center></span>";
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




 
