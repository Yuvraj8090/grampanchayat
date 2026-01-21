<?php 
  include 'header.php';
?>

<br/>
<div class="body">
  <div class="left_box">
    <div class="form_box">
        <fieldset>
            <legend><h2>Registration Form</h2><hr style="margin-top:5px;" /></legend>
            <form action="#" method="post">
                <span>Name:</span><input type="text" name="name" placeholder="Full Name" class="input" style="margin-left:140px;" required="required"><br/><br/>
                <span>Age:</span>
                <select name="age" class="input" style="margin-left:150px;" required="required">
                <?php 
                    for($i=0; $i<=105; $i++)
                    {
                        echo"<option value=".$i.">".$i."</option>";
                    }
                ?>   
                </select><br/><br/>
                <span>Phone Number:</span><input type="number" name="ph_number" placeholder="Phone Number" class="input" style="margin-left:74px;" required="required"><br/><br/>
                <span>Email:</span><input type="email" name="email" placeholder="Email" class="input" style="margin-left:142px;" required="required"><br/><br/>
                <span>Pin Code:</span><input type="number" name="pin_code" placeholder="Pin Code" class="input" style="margin-left:117px;" required="required"><br/><br/>
                <span>Gram Panchayat Name:</span>
                <select name="gp_name" class="input" style="margin-left:10px;" required="required">
                    <option></option><option>Sorna</option><option>Bhagvantpur</option><option>Dehradun</option>
                </select><br/><br/>
                <span>Occupation:</span>
                <select name="occupation" class="input" style="margin-left:98px;" required="required">
                    <option></option><option>Government Job</option><option>Private Job</option><option>Self-Employed</option><option>Farmer</option>
                </select><br/><br/>
                <span>Qualification:</span>
                <select name="qualification" class="input" style="margin-left:90px;" required="required">
                    <option></option><option>Uneducated</option><option>5th</option><option>8th</option><option>10th</option><option>12th</option><option>Graduate</option><option>Post-Graduate</option>
                </select><br/><br/>
                <span>Stream:</span>
                <select name="stream" class="input" style="margin-left:128px;" required="required">
                    <option></option><option>Arts</option><option>Commerce</option><option>Science</option>
                </select><br/><br/>
                <center><input type="submit" name="submit" value="Submit" style="width:20%;cursor:pointer;"><input type="reset" name="reset" value="Reset" style="width:20%;cursor:pointer;"></center>
            </form>
        </fieldset>
          
    <?php 
      if (isset($_POST['submit'])) 
      {
         $connect= mysqli_connect("localhost", "root", "","admin");
          mysqli_set_charset( $connect, 'utf8');
          $name = mysqli_real_escape_string($connect, $_REQUEST['name']);
          $age = mysqli_real_escape_string($connect, $_REQUEST['age']);
          $ph_number = mysqli_real_escape_string($connect, $_REQUEST['ph_number']);
          $email = mysqli_real_escape_string($connect, $_REQUEST['email']);
          $pin_code = mysqli_real_escape_string($connect, $_REQUEST['pin_code']);
          $gp_name = mysqli_real_escape_string($connect, $_REQUEST['gp_name']);
          $occupation = mysqli_real_escape_string($connect, $_REQUEST['occupation']);
          $qualification = mysqli_real_escape_string($connect, $_REQUEST['qualification']);
          $stream = mysqli_real_escape_string($connect, $_REQUEST['stream']);

          $en_ph_number = base64_encode($ph_number);
          $en_email = base64_encode($email);

          $insert = "INSERT INTO registration_data (name, age, ph_number, email, pin_code, gp_name, occupation, qualification, stream) VALUES ('$name', '$age', '$en_ph_number', '$en_email', '$pin_code', '$gp_name', '$occupation', '$qualification', '$stream')";
          $query = mysqli_query($connect , $insert);
          if ($query) 
          {
              echo "<span style='font-weight:bold;color:green;font-size:30px;'><center>Added Successfully</center></span>";
          }
          else
          {
              echo "<span style='font-weight:bold;color:red;font-size:30px;'><center>Not Added</center></span>";
          }

      }
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