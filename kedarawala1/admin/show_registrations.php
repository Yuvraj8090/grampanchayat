
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
         <a href="view_registrations.php">Go Back</a><br/><br/>
        <?php 
            include 'conn.php';
            $id = $_REQUEST['id'];

            $fetch = "SELECT * FROM registration_data WHERE id = $id";
            $query = mysqli_query($con, $fetch);
            $result = mysqli_fetch_assoc($query);

            $phone_no = $result['ph_number'];
            $decoded_data = base64_decode($phone_no);
            $email = $result['email'];
            $decoded_data_email = base64_decode($email);

           echo "<table border='1px' width='100%' cellpadding='10px' style='font-size:18px;'>";
           echo "<tr>";
           echo "<td><b>Name</b></td>";
           echo "<td>".$result['name']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Age</b></td>";
           echo "<td>".$result['age']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Phone Number</b></td>";
           echo "<td>".$decoded_data."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Email</b></td>";
           echo "<td>".$decoded_data_email."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Pin Code</b></td>";
           echo "<td>".$result['pin_code']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Gram Panchayat Name</b></td>";
           echo "<td>".$result['gp_name']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Occupation</b></td>";
           echo "<td>".$result['occupation']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Qualification</b></td>";
           echo "<td>".$result['qualification']."</td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td><b>Stream</b></td>";
           echo "<td>".$result['stream']."</td>";
           echo "</tr>";
           echo "</table>";
            
        ?>
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




 
