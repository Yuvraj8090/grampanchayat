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
            <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <fieldset style="font-size:16px;">
                    <legend style="margin-left:10px;width:160px;font-size:30px;">पंचायत स्तर</legend>
                    <span class="control-label col-lg-4" style="font-size:20px;">नाम:</span><input type="text" name="jname" class="form-control" style="width:60%;" placeholder="नाम"><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">पद:</span> <select name="position" class="form-control" style="width:60%;">
                        <option value="select"></option value="प्रधान"><option>प्रधान </option><option>उपप्रधान </option><option>सदस्य</option>
                    </select><br/><br/>
                   <span class="control-label col-lg-4" style="font-size:20px;">वार्ड:</span> 
                   <select name="block" class="form-control" style="width:60%;">
                        <option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>
                    </select><br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;"> फ़ोन नंबर :</span> <input type="number" name="phone_number" class="form-control" style="width:60%;"> <br/><br/>
                    <span class="control-label col-lg-4" style="font-size:20px;">फोटो:</span> <input type="file" name="janphoto" style="margin-left:78px;"><br/><br/>
                    <input type="submit" name="submit" value="Submit" style="margin-left:350px;">
                    <input type="reset" name="reset">
                </fieldset>
            </form>
            </div>
            <?php  
if (isset($_POST['submit'])) 
{
    include 'conn.php';
     mysqli_set_charset( $con, 'utf8');
    $jname = mysqli_real_escape_string($con, $_REQUEST['jname']);
    $position = mysqli_real_escape_string($con, $_REQUEST['position']);
    $block = mysqli_real_escape_string($con, $_REQUEST['block']);
    $phone_number = mysqli_real_escape_string($con, $_REQUEST['phone_number']);
        $janphoto = $_FILES["janphoto"]["name"];
        $path = "janphoto/";
        $janphoto = $path.$_FILES["janphoto"]["name"];

    
    
    $match = "SELECT position From janparthinidhi Where position='$position'";
    $q=mysqli_query($con,$match);
    $query = mysqli_fetch_assoc($q);
    $dposition=$query['position'];
    if ($dposition!='प्रधान' && $dposition!='उपप्रधान') 
    {
       
     $insert = "INSERT INTO janparthinidhi (jname, position, block, phone_number, janphoto) VALUES ('$jname', '$position', '$block', '$phone_number', '$janphoto')";
    $add = mysqli_query($con, $insert);

    if ($add) 
    {
        move_uploaded_file($_FILES["janphoto"]["tmp_name"], $janphoto);
        echo "<span style='font-weight:bold;color:green;font-size:30px;'><center>Added Successfully</center></span>";
    }
    else
    {
        echo "<span style='font-weight:bold;color:red;font-size:30px;'><center>Not Added</center></span>";
    }
    }
    else
    {
        echo "<span style='font-weight:bold;color:red;font-size:30px;'><center>You Can't be ".$position."</center></span>";
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
