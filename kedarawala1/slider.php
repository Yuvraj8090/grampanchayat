<div class='slider'>
				<div id='hislider1' style='max-width:1000px;  max-height:350px; margin: 0 auto;'>
        			<ul style='display: none;overflow: hidden; height: 0; visibility: hidden; opacity: 0;'>
<?php
 include 'conn.php';
             mysqli_set_charset( $con, 'utf8');
                $sql = "SELECT image,alt FROM slider_images LIMIT 5";
                $query = mysqli_query($con, $sql);
               	if (mysqli_num_rows($query) > 0) 


{
	 while($row = mysqli_fetch_assoc($query)) 
                        {
	echo "				<li>
							<div>
								<img data-src='admin/".$row['image']."' data-thumb-src='admin/".$row['image']."' title='".$row['alt']."' alt='' data-content-type='image' data-content='' data-interval='-1'/>
 								<div data-type='effect' data-effect-type='Fade' data-duration=1500 data-easing='easeInOutQuart'></div>
 								
							</div>
						</li>
						
						";
					}
}
		?>
	</ul></div>