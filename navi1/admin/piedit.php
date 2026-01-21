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
    <a href="place_intro.php">Go Back</a>
        <?php 
include("conn.php");
mysqli_set_charset( $con, 'utf8');
$id=$_REQUEST['id'];
$sql = "SELECT  id, intro FROM place_intro where id='$id' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
{
     $intro=$row["intro"];
     $id=$row["id"];
  } 
}
?>
 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'input' });</script>
<div class="form" style="margin-top:20px;">
<form action="#" method="post"/>
     <input type="text" name="intro" value="<?php echo $intro; ?>" style="height:50%;">
	 <br/><br/>
     <button name="submit" style="margin-left:400px;">Submit</button><br/><br/>
       <?php  
        if (isset($_REQUEST['submit'])) 
        {
          include('conn.php');
          mysqli_set_charset( $con, 'utf8');
          $intro = mysqli_real_escape_string($con, $_POST['intro']);
          
          $update = "UPDATE place_intro SET intro = '$intro' WHERE id = '$id'";
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




 
