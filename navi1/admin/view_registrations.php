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
         <a href="dashboard.php">Go Back</a><br/><br/>
        <?php 
            $connect= mysqli_connect("localhost", "grampanc_admin", "SbD*oGMfSh6~","grampanc_admin");
            $fetch = "SELECT id, name, ph_number, gp_name FROM registration_data";
            $query = mysqli_query($connect, $fetch);

            echo "<table border='1px' width='100%'>";
            echo "<tr><td>S.No</td><td>Name</td><td>Phone Number</td><td>Grampanchayat Name</td><td>Operator</td></tr>";

            $i = 1;

            while ($result = mysqli_fetch_assoc($query)) 
            {
                $phone_no = $result['ph_number'];
                $decoded_data = base64_decode($phone_no);

                echo "<tr><td>".$i."</td><td><a href='show_registrations.php?id=".$result['id']."'>".$result['name']."</a></td><td>".$decoded_data."</td><td>".$result['gp_name']."</td><td><a href='reg_delete.php?id=".$result['id']."'>delete</a></td></tr>";
               
               $i++;
            }
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




 
