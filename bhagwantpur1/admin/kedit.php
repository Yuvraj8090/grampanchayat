
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
    <a href="key_facts.php">Go Back</a>
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT  id, facts, number FROM key_facts WHERE id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $facts=$row["facts"];
	 $number = $row["number"];
     $id=$row["id"];
  } 
}
?>
<div class="form" style="margin-top:20px;">
<form action="#" method="post"/>
     <span class="control-label col-lg-4" style="font-size:20px;">ID:</span><input type="text" name="id"  class="form-control" style="width:60%;" value="<?php echo $id; ?>" readonly/><br/><br/>
     <span class="control-label col-lg-4" style="font-size:20px;"> मुख्य तथ्य:</span><input type="text" name="facts" class="form-control" style="width:60%;" value="<?php echo $facts; ?>"><br/><br/>
	 <span class="control-label col-lg-4" style="font-size:20px;"> संख्या:</span><input type="text" name="number" class="form-control" style="width:60%;" value="<?php echo $number; ?>"><br/><br/>
     <input type="submit" name="submit" style="margin-left:400px;" value="Submit" /><br/><br/>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
          mysqli_set_charset( $con, 'utf8');
          $id = mysqli_real_escape_string($con, $_POST['id']);
          $programme = mysqli_real_escape_string($con, $_POST['facts']);
		  $number = mysqli_real_escape_string($con, $_POST['number']);
		  
          
          $update = "UPDATE key_facts SET facts = '$facts', number = '$number' WHERE id = '$id'";
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




 
