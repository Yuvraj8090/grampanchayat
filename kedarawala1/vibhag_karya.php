<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	
		<center><h2>ग्राम पंचायत में हुए अन्य विभाग कार्य की झलक</h2></center>
		<br/>
		<div class="table" style="padding:20px;">
			<?php 
                include 'conn.php' ;
                mysqli_set_charset( $con, 'utf8');

                $sql="SELECT * FROM vibhag_karya where ddelete=0 ";
                $result= mysqli_query($con, $sql);
                $rowcount=mysqli_num_rows($result);

                if($rowcount)
                {
                    $result= mysqli_query($con, $sql);
                              
                    echo '<table border="1px" width="100%">';
                    echo '<tr><th>क्रमांक</th><th>ईयर</th><th> विभाग कार्य का नाम </th><th>  डिस्क्रिप्शन </th></tr>';

                    $i=1;
                    while($row=mysqli_fetch_assoc($result))                              
                    {                      
                        echo '<tr><td>'.$i.'</td><td>'.$row['year'].'</td><td>'.$row["name"].'</td><td>'.$row["description"].'</td></tr>';
                        $i++;                  
                    } 
                }
                else
                {
                    echo "<span style='font-weight:bold;'><center>no record</center></span>";
                }
                    echo '</table>'
            ?>
		</div><br/>
	
		<span style="margin-left:15px;">नोट: प्रधान जी द्वारा किये गये जनहित कार्यों का विवरण है, यह एक विकास वर्ष दिखलाता है | ज्यादा जानकारी के लिए प्रधान जी सम्पर्क करे | </span>

</div><br/>
<?php 
	include 'footer.php';
?>