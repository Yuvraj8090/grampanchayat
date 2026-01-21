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
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT * FROM vibhag_karya where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $year=$row["year"];
     $id=$row["id"];
     $name=$row["name"];  
     $description=$row["description"];
  } 
}
?>
<div class="form" style="margin-top:20px;">
<form action="#" method="post" enctype="multipart/form-data" />
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id"  class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">ईयर:</span><input type="text" name="year" class="form-control" style="width:60%;" value="<?php echo $year; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">विभाग कार्य का नाम :</span><input type="text"  name="name" class="form-control" style="width:60%;" value="<?php echo $name; ?>"><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">डिस्क्रिप्शन :</span><input type="text"  name="description" class="form-control" style="width:60%;" value="<?php echo $description; ?>"><br/><br/>
     <input type="submit" name="submit" style="margin-left:400px;" value="Submit" /><br/><br/>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
           mysqli_set_charset( $con, 'utf8');
          $id = mysqli_real_escape_string($con, $_POST['id']);
          $year = mysqli_real_escape_string($con, $_POST['year']);
          $name = mysqli_real_escape_string($con, $_POST['name']);
          $description = mysqli_real_escape_string($con, $_POST['description']);
          
          $update = "UPDATE vibhag_karya SET year = '$year', name = '$name', description = '$description'WHERE id = '$id'";
          $query = mysqli_query($con,$update);
          if($query)
          {
            echo "<script>alert ('Edited Successfully')</script>";
          }
          else
          {
              echo "<script>alert ('Not Edited')</script>";
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




 
