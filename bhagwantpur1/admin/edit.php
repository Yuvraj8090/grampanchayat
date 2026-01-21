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
    <a href="vikaskarye.php">Go Back</a>
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT  id, dworkname, about_work, plan_name, year, price, progress_status FROM development_works where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $dworkname=$row["dworkname"];
     $id=$row["id"];
     $about_work=$row["about_work"];  
     $plan_name=$row["plan_name"];
     $year=$row["year"];
     $price=$row["price"];
   $progress_status=$row["progress_status"];
  } 
}
?>
<div class="form" style="margin-top:20px;">
<form action="#" method="post" enctype="multipart/form-data" />
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id"  class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">कार्य का नाम:</span><input type="text" name="dworkname" class="form-control" style="width:60%;" value="<?php echo $dworkname; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">कार्य के बारेमे:</span><input type="text"  name="about_work" class="form-control" style="width:60%;" value="<?php echo $about_work; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">योजना का नाम:</span><input type="text"  name="plan_name" class="form-control" style="width:60%;" value="<?php echo $plan_name; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">वर्ष दिनक:</span><input type="text" name="year" class="form-control" style="width:60%;" value="<?php echo $year; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">राशि:</span><input type="text" name="price" class="form-control" style="width:60%;" value="<?php echo $price; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">स्तीथि:</span><input type="text" name="progress_status" class="form-control" style="width:60%;" value="<?php echo $progress_status; ?>"><br/><br/>
     <input type="submit" name="submit" style="margin-left:400px;" value="Submit" /><br/><br/>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
           mysqli_set_charset( $con, 'utf8');
          $id = mysqli_real_escape_string($con, $_POST['id']);
          $dworkname = mysqli_real_escape_string($con, $_POST['dworkname']);
          $about_work = mysqli_real_escape_string($con, $_POST['about_work']);
          $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
          $year = mysqli_real_escape_string($con, $_POST['year']);
          $price = mysqli_real_escape_string($con, $_POST['price']);
          $progress_status = mysqli_real_escape_string($con, $_POST['progress_status']);
          
          $update = "UPDATE development_works SET dworkname = '$dworkname', about_work = '$about_work', plan_name = '$plan_name', year = '$year', price = '$price', progress_status = '$progress_status' WHERE id = '$id'";
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




 
