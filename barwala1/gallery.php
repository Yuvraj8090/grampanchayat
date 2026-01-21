<?php include ('header.php'); ?>

<link href="css/banner.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="../jquery-min.js"></script>
<script type="text/javascript" src="../js/picbox.js"></script>
<link rel="stylesheet" href="../css/picbox.css" type="text/css" media="screen" />

<!--Start Glimmer Insertion-->
<script type='text/javascript' src='../js/jquery-1.3.2.min.js'></script>
<!--glimmer generated file--><script type='text/javascript' src='../js/banner.html.glimmer.js'></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.als-1.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 1,
					scrolling_items: 1,
					orientation: "horizontal",
					circular: "yes",
					autoscroll: "yes",
					interval: 5000,
					direction: "right",
					start_from: 1
				});
				
			
				
			
			});
		</script>



<!--<div id="slider">
             Gmap
		
      </div>   -->
    
        <div id="content">
                                     
            <div id="contentleft">
			 <h2 align="center"> ग्राम पंचायत की फोटो गैलरी </h2>
			
			<ul>
			<?php  $handle = opendir(dirname(realpath(__FILE__)).'/gallery/');
        while($file = readdir($handle))
		{
            if($file !== '.' && $file !== '..'){
				//echo $file;
				
				//echo $file1=@str_replace(array(‘.jpg’, ‘.png’, ‘.gif’), ”, $file);
                $ext=array(".jpg",".png",".gif");
				$file1=str_replace($ext,"",$file);
				
				echo '<li> <a rel="lightbox-demo" href="gallery/'.$file.'" ><img src="gallery/'.$file.'" border="0" height="150"  width="150" alt="'.$file1.'"  title="'.$file1.'" /></a></li>';
            }
        
		
			
				}
		?>
			<div class="cl"></div>
			
			
			</ul>
			<br/>
	<br/>
               
 <?php include'historyman.php'; ?>
                <div class="cl"></div>
                
                 </div>
            </div>
             <div>
			 <div id="contentright">
				<?php include('rightarea.php');?>
				<?php include('/home/grampanc/public_html/rightareaads.php');?>
          </div>
		     <div class="cl"></div>
        </div>
              
      <?php include '/home/grampanc/public_html/footer.php' ;?>
    </div> <!-- main container close -->


    </body>
</html>
