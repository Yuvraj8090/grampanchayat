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
        <form action="#" method="post" enctype="multipart/form-data">
          <span class="col-lg-4" style="font-size:20px;">Sender ID:</span> <input type="text" name="sender_id" placeholder="Sender ID" style="width:60%;" class="form-control" required><br/><br/>
          <span class="col-lg-4" style="font-size:20px;">Mobile Number:</span> <input type="number" name="mobile_number" style="width:40%;" placeholder="Mobile Number" class="form-control" required> <br/>
          <span class="col-lg-4" style="font-size:20px;">File Upload</span><input type="file" name="file" ><br/>
          <span style="margin-left:40%;font-size:20px;">OR</span><br/><br/>
          <span class="col-lg-4" style="font-size:20px;">Message:</span> <textarea cols="30px" rows="6" placeholder="Message" style="width:60%;" name="message" class="form-control"></textarea><br/><br/>
          <center><input type="submit" name="submit" value="Send"></center>
        </form>
        <?php  
          if (isset($_POST['submit'])) 
          {
            $sender_id = $_POST['sender_id'];
            $mobile_number = $_POST['mobile_number'];

            $file = $_FILES["file"]["name"];
            $path = "message/";
            $file = $path.$_FILES["file"]["name"];

            $message = $_POST['message'];
            include 'conn.php';

            $insert = "INSERT INTO message (sender_id, mobile_number, file, message) VALUES ('$sender_id', '$mobile_number', '$file', '$message')";
            $add = mysqli_query($con, $insert);

            if ($add) 
             {
                move_uploaded_file($_FILES["file"]["tmp_name"], $file);
                echo "<span style='font-weight:bold;color:green;font-size:30px;'><center>Message Sent</center></span>";
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




 
