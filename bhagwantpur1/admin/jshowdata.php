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
    
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=mysqli_real_escape_string($con, $_REQUEST['id']);
$sql = "SELECT  id, jname, position, block, phone_number FROM janparthinidhi where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $jname=$row["jname"];
     $id=$row["id"];
     $position=$row["position"];  
     $block=$row["block"];
     $phone_number=$row["phone_number"];
    
  } 
}
?>
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id" class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
      <?php 
      include 'conn.php';
$id=mysqli_real_escape_string($con, $_REQUEST['id']);
$sql = "SELECT janphoto FROM janparthinidhi where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     echo ' <span class="control-label col-lg-4" style="font-size:20px;">फोटो:</span><a href="' . $row['janphoto'] . '"><img src="' . $row['janphoto'] . '" alt="no image" height="150px" width="150px"/></a>';
       } 
}
?><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">नाम:</span><input type="text" name="jname" class="form-control" style="width:60%;" value="<?php echo $jname; ?>" readonly><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">पद:</span><input type="text"  name="position" class="form-control" style="width:60%;" value="<?php echo $position; ?>" readonly><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;">वार्ड:</span><input type="text"  name="block" class="form-control" style="width:60%;" value="<?php echo $block; ?>" readonly><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;"> फ़ोन नंबर:</span><input type="text" name="phone_number" class="form-control" style="width:60%;height:auto;" value="<?php echo $phone_number; ?>" readonly><br/><br/>     
    </form>
   
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




 
