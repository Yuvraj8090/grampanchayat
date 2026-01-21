<div class="right_box">
					<div class="news">
						<h2 class="h2">ताजा खबरे </h2>
							<ul>
								<?php 
									 $connect = mysqli_connect("localhost", "grampanc_wp390", "p2Sn5G0.]0", "grampanc_wp390");
                    				mysqli_set_charset( $connect, 'utf8');

                    				$sql="SELECT ID, post_title FROM wpbq_posts ORDER BY post_date DESC LIMIT 5";
                    				$result= mysqli_query($connect, $sql);
                     				$rowcount=mysqli_num_rows($result);


                     				if($rowcount)
                      				{
                         				$result= mysqli_query($connect, $sql);
                             			
                             			while($row=mysqli_fetch_assoc($result))  
                             			{                       
                                			echo '<li><a href="show.php?ID='.$row['ID'].'" style="color:blue;">'.$row["post_title"].'</a></li>';
                      					} 
                        			}	
                    				else
                          			{
                               			echo "<span style='font-weight:bold;'><center>no record found</center></span>";
			                        }
								?>
							</ul>
					</div><br/>
					<div class="news">
						<h2 class="h2">Running योजनाए </h2>
							<ul>
								<?php 
									include 'conn.php' ;
                    				mysqli_set_charset( $con, 'utf8');

                    				$sql="SELECT id, title, programme FROM running_programme";
                    				$result= mysqli_query($con, $sql);
                     				$rowcount=mysqli_num_rows($result);


                     				if($rowcount)
                      				{
                         				$result= mysqli_query($con, $sql);
                             			
                             			while($row=mysqli_fetch_assoc($result))  
                             			{                       
                                			echo '<li><a href="show_r.php?id='.$row['id'].'" style="color:blue;">'.$row["title"].'</a></li>';
                      					} 
                        			}	
                    				else
                          			{
                               			echo "<span style='font-weight:bold;'><center>no record found</center></span>";
			                        }
								?>
							</ul>
					</div><br/>
          
					<iframe width="100%" height="315" src="https://www.youtube.com/embed/w094XoSoS_0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><br/><br/>
          <div class="news">
            <h2 class="h2">सरकारी नौकरियों </h2>
              <ul>
                <?php 
                  include 'conn.php' ;
                            mysqli_set_charset( $con, 'utf8');

                            $sql="SELECT id, title FROM jobs";
                            $result= mysqli_query($con, $sql);
                            $rowcount=mysqli_num_rows($result);


                            if($rowcount)
                              {
                                $result= mysqli_query($con, $sql);
                                  
                                  while($row=mysqli_fetch_assoc($result))  
                                  {                       
                                      echo '<li><a href="show_jobs.php?id='.$row['id'].'" style="color:blue;">'.$row["title"].'</a></li>';
                                } 
                              } 
                            else
                                {
                                    echo "<span style='font-weight:bold;'><center>no record found</center></span>";
                              }
                ?>
              </ul>
          </div><br/>
					<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FGram-Panchayat-Uttarakhand%2F1387967154836074&amp;width=250&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=210570505764008" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
				</div>