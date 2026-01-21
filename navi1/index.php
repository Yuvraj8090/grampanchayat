<?php 
	include 'header.php';
?>
<?php 
	include 'slider.php';
?>
			<div class="body">
				<div class="left_box">
					<div class="heading">ग्राम पंचायत में आपका स्वागत है </div>
					<div class="matter">
						<?php 
							include 'conn.php' ;
                      			mysqli_set_charset( $con, 'utf8');

                     			$sql="SELECT id, intro FROM introduction";
                      			$result= mysqli_query($con, $sql);
                       			$rowcount=mysqli_num_rows($result);


                      			if($rowcount)
                       			 {
                          			$result= mysqli_query($con, $sql);
                              
                              		
                             		while($row=mysqli_fetch_assoc($result))                              
                             		{                          
                                 		echo '<tr><td>'.$row["intro"].'</td></tr>';
                              		} 
                             	}
                   				else
                        		{
                            	   echo "<span style='font-weight:bold;'><center>no record</center></span>";

                      			  }
						?>
					</div>
					<div class="table">
						<table border="1px" width="100%">
							<tr>
								<th>क्रमांक</th>
								<th>मुख्य तथ्य</th>
								<th>संख्या</th>
							</tr>
							<?php 
								include 'conn.php' ;
                      			mysqli_set_charset( $con, 'utf8');

                     			$sql="SELECT id, facts, number FROM key_facts ORDER BY id ASC";
                      			$result= mysqli_query($con, $sql);
                       			$rowcount=mysqli_num_rows($result);


                      			if($rowcount)
                       			 {
                          			$result= mysqli_query($con, $sql);
                              
                              		$i=1;
                             		while($row=mysqli_fetch_assoc($result))                              
                             		{                          
                                 		echo '<tr><td>'.$i.'</td><td>'.$row["facts"].'</td><td>'.$row["number"].'</td></tr>';
                                 		$i++;
                                
                             		} 
                             	}
                   				else
                        		{
                            	   echo "<span style='font-weight:bold;'><center>no record</center></span>";

                      			  }
							?>
						</table>
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