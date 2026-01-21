<?php 
	include 'header.php';
?>
<br/>
<div class="body">
	
		<center><h2>ग्राम पंचायत में हुए विकास कार्यो की झलक</h2></center>
		<br/>
		<div class="table" style="padding:20px;">
			<?php 
                include 'conn.php' ;
                mysqli_set_charset( $con, 'utf8');

                $sql="SELECT id, dworkname, about_work, plan_name, year, price, progress_status FROM development_works where ddelete=0";
                $result= mysqli_query($con, $sql);
                $rowcount=mysqli_num_rows($result);

                if($rowcount)
                {
                    $result= mysqli_query($con, $sql);
                              
                    echo '<table border="1px" width="100%">';
                    echo '<tr><th>क्रमांक</th><th>कार्य का नाम</th><th> कार्य के बारेमे</th><th>  योजना का नाम</th><th> वर्ष दिनक</th><th>राशि </th><th>स्तीथि</th></tr>';

                    $i=1;
                    while($row=mysqli_fetch_assoc($result))                              
                    {                      
                        echo '<tr><td>'.$i.'</td><td><a href="showdata.php?id='.$row["id"].'" style="color:blue;">'.$row["dworkname"].'</a></td><td>'.$row["about_work"].'</td><td>'.$row["plan_name"].'</td><td>'.$row["year"].'</td><td>'.$row["price"].'</td><td>'.$row["progress_status"].'</td></tr>';
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