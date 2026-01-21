<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	include "header.php";
?>
<div class="slider">
	<iframe src="https://www.google.com/maps/d/u/3/embed?mid=1goxxFWpqFzB0Vnr3FEhbFK3uB_U" width="100%" height="300"></iframe>
</div>
<div class="body">
	<div class="left_box">
		<br/>
		<div class="heading">भगवन्तपुर ग्राम पंचायत</div>
		<div class="table">
			<?php 
                include 'conn.php' ;
                mysqli_set_charset( $con, 'utf8');

                $sql="SELECT id, address FROM address";
                $result= mysqli_query($con, $sql);
                $rowcount=mysqli_num_rows($result);


                if($rowcount)
                {
                    $result= mysqli_query($con, $sql);
                              
                    echo '<table border="1px" width="100%">';
                    echo '<tr><th>पता </th></tr>';

                               
                    while($row=mysqli_fetch_assoc($result))                              
                    {  
                        echo '<tr><td>'.$row["address"].'</td></tr>';         
                    }
                }
                else
                {
                    echo "<span style='font-weight:bold;'><center>No Record Found</center></span>";
                }
                    echo '</table>'
            ?>			
		</div>
		<br/><br/>
		<div class="heading">भगवन्तपुर ग्राम पंचायत मे पहुचने के साधन</div>
		<div class="table">
			<table border="1px" width="100%">
    			<thead><th>क्रमांक</th><th>मुख्य तथ्य</th></thead>
          	    <tbody>
      	            <tr><td>1</td><td>देहरादून परैड ग्राउंड  से हर 30 मिनिट में बस सर्विस सायं 7 बजे पुरकुल तक. </td></tr>               
                </tbody>
            </table>
		</div>
		<br/><br/>
		<div class="heading">भगवन्तपुर ग्राम पंचायत से जनपद स्तर के मुख्य विभाग और उनकी दुरी</div>
		<div class="table">
			<?php 
                include 'conn.php' ;
                mysqli_set_charset( $con, 'utf8');

                $sql="SELECT id, name, place, distance FROM location ORDER BY id ASC";
                $result= mysqli_query($con, $sql);
                $rowcount=@mysqli_num_rows($result);
                if($rowcount)
                {
                    $result= mysqli_query($con, $sql);
                              
                    echo '<table border="1px" width="100%">';
                    echo '<tr><th>क्रमांक</th><th>विभाग का नाम</th><th>पता </th><th> दुरी (लगभग) </th></tr>';

                    $i=1;
                    while($row=mysqli_fetch_assoc($result))                              
                    {                          
                        echo '<tr><td>'.$i.'</td><td>'.$row["name"].'</td><td>'.$row["place"].'</td><td>'.$row["distance"].'</td></tr>';
                        $i++;                                
                    } 
                }
                else
                {
                    echo "<span style='font-weight:bold;'><center>No Record Found</center></span>";
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
</body>
</html>