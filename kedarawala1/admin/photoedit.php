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
    <a href="gallery.php">Go Back</a>
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT  id, alt FROM gallery where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $alt=$row["alt"];
     $id=$row["id"];
  } 
}
?>
<div class="form" style="margin-top:20px;">
    <form action="#" method="post" enctype="multipart/form-data">
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id"  class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
    <span class="control-label col-lg-4" style="font-size:20px;">Image Discription:</span><input type="text" name="alt"  class="form-control" style="width:60%;" value="<?php echo $alt; ?>" required><br/><br/>
        <span class="control-label col-lg-4" style="font-size:20px;">Choose File:</span><input type="file" name="gallery" style="margin-left:20px;"><br/>
       <center><input type="submit" name="submit" value="submit"></center>
    </form>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
          mysqli_set_charset( $con, 'utf8');
          $id = mysqli_real_escape_string($con, $_POST['id']);
          $alt = mysqli_real_escape_string($con, $_POST['alt']);
          
            $gallery = $_FILES["gallery"]["name"];
            $path = "../gallery/";
            $gallery = $path.$_FILES["gallery"]["name"];
          
          $update = "UPDATE gallery SET alt = '$alt', gallery = '$gallery' WHERE id = '$id'";
          $query = mysqli_query($con,$update);
          if($query)
          {
            move_uploaded_file($_FILES["gallery"]["tmp_name"], $gallery);
            echo "<center style='font-weight:bold;font-size:20px;color:green;'>Edited Successfully</center>";
          }
          else
          {
              echo "<center style='font-weight:bold;font-size:20px;color:red;'>Not Edited</center>";
        }
        }
        ?>
    </form>
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




 
