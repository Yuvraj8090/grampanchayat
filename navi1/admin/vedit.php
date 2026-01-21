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
    <a href="videos.php">Go Back</a>
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT  id, title, url, about FROM video where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $title=$row["title"];
     $id=$row["id"];
     $url=$row["url"];  
     $about=$row["about"];
    
  } 
}
?>
<div class="form" style="margin-top:20px;">
<form action="#" method="post" />
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id"  class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">Title:</span><input type="text" name="title" class="form-control" style="width:60%;" value="<?php echo $title; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">वीडियो :</span><input type="text"  name="url" class="form-control" style="width:60%;" value="<?php echo $url; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">  बारे में:</span><input type="text"  name="about" class="form-control" style="width:60%;" value="<?php echo $about; ?>"><br/><br/>
     <input type="submit" name="submit" style="margin-left:400px;" value="Submit" /><br/><br/>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
           mysqli_set_charset( $con, 'utf8');
          $id = mysqli_real_escape_string($con, $_POST['id']);
          $title = mysqli_real_escape_string($con, $_POST['title']);
          $url = mysqli_real_escape_string($con, $_POST['url']);
          $about = mysqli_real_escape_string($con, $_POST['about']);
          
          $update = "UPDATE video SET title = '$title', url = '$url', about = '$about' WHERE id = '$id'";
          $query = mysqli_query($con,$update);
          if($query)
          {
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




 
