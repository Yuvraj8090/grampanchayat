<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	<div class="left_box">
		<center><h2>ग्राम पंचायत के प्रमुख जन प्रतिनिधि</h2></center>
		<br/>
		<div class="table">
			<?php 
                include 'conn.php' ;
                mysqli_set_charset( $con, 'utf8');

                $sql="SELECT id, jname, position, block, phone_number FROM janparthinidhi ORDER BY id DESC";
                $result= mysqli_query($con, $sql);
                $rowcount=mysqli_num_rows($result);

                if($rowcount)
                {
                    $result= mysqli_query($con, $sql);
                              
                    echo '<table border="1px" width="100%">';
                    echo '<tr><th>क्रमांक</th><th>नाम </th><th> पद </th><th>वार्ड </th><th> फ़ोन नंबर  </th></tr>';

                    $i=1;
                    while($row=mysqli_fetch_assoc($result))                              
                    {                                 
                        echo '<tr><td>'.$i.'</td><td><a href="jshowdata.php?id='.$row["id"].'" style="color:blue;">'.$row["jname"].'</a></td><td>'.$row["position"].'</td><td>'.$row["block"].'</td><td>'.$row["phone_number"].'</td></td></tr>';
                        $i++;
                    }
                }
                else
                {
                    echo "<span style='font-weight:bold;'><center>no record found</center></span>";
                }
                    echo '</table>'
            ?>
		</div>
	</div>
<?php 
	include 'rightbox.php';
?>
<div class="clear"></div>
</div>
<?php 
	include 'footer.php';
?>