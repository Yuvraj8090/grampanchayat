<?php 
session_start();
if(empty($_SESSION['usera']))
{
header("Location:http://localhost/studentmanagement/admin12");
}?>
<?php include'header.php'?><body>
<div id="main">
  <?php include'menuheader.php'?>
  <!-- /header -->
  <hr class="noscreen" />
  <!-- Columns -->
  <div id="cols" class="box">
  <?php  include'menuleft1.php' ?>
    <!-- /aside -->
    <hr class="noscreen" />
    <!-- Content (Right Column) -->

  <div id="content" class="box">
  <h3 class="tit">LIST OF ALL STUDENTS</h3>
  
 
<?php  
include("conn.php");
$sql = "SELECT id, name, age, course FROM students";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{
echo "<table border='1'>";
echo "<tr><th>name</th><th>age</th><th>course</th><th>operation</th><tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
{
    echo "<tr><td>" . $row["name"]. "</td><td> " . $row["age"]. "</td><td> " . $row["course"]."</td><td>". '<a href="view.php?name='.$row["name"].'">view</a>'."<br>". '<a href="delete.php?name='.$row["name"].'">delete</a>'."<br>". '<a href="edit.php?id='.$row["id"].'">edit</a>'."<br>". '<a href="fees.php?id='.$row["id"].'">fees</a>'."</td></tr>";
}
echo "</table>";
} 
else {
    echo "0 results";
}
mysqli_close($conn);
?>
   </div>
    <!-- /content -->
  </div>
  <!-- /cols -->
  <hr class="noscreen" />
  <!-- Footer -->
  </div>
  <!-- /footer -->
</div>
<!-- /main -->
</body>
</html>


	  
	  