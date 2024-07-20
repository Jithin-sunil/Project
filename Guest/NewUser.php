<?php

include('../Assets/Connection/Connection.php');

if(isset($_POST['btnsubmit'])!=null)
{
	$name=$_POST['txtname'];
	$gender=$_POST['gender'];
	$contact=$_POST['txtcontact'];
    $email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$place=$_POST['sel_place'];
	$address=$_POST['txtaddress'];
	
	$photo=$_FILES['filephoto']['name'];
	$temp=$_FILES['filephoto']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/UserDocs/'.$photo);
	
	$proof=$_FILES['fileproof']['name'];
	$temp=$_FILES['fileproof']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/UserDocs/'.$proof);
	
	
	
	$insQry="insert into tbl_user(user_name,user_gender,user_contact,user_email,user_password,place_id,user_photo,user_proof,user_address)
	values('$name','$gender','$contact','$email','$password','$place','$photo','$proof','$address')";
	
	if($con->query($insQry))
		{
					echo"inserted";
		}
}
?>
















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NewUser</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="402" height="338" border="1">
    <tr>
      <td width="73" height="32">Name</td>
      <td width="111"><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="gender" id="gender" value="Male" />
        Male  <input type="radio" name="gender" id="gender" value="Female" />
        <label for="rfemale">Female</label></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail" /></td>
    </tr>
     <tr>
      <td>Address</td>
      <td><label for="txtaddress"></label>
       <textarea name="txtaddress" id="txtaddress" cols="45" rows="5"></textarea></td>
    </tr>
    
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txtpassword"></label>
      <input type="Password" name="txtpassword" id="txtpassword" /></td>
    </tr>
    <tr>
      <td>Confirm password</td>
      <td><label for="txtconfirmpassword"></label>
      <input type="Password" name="txtconfirmpassword" id="txtconfirmpassword" /></td>
    </tr>
    <tr>
   <td>District</td>
   
   <td>
   <select name="selDistrict" onchange="getPlace(this.value)">
   <option value="-----select-----">---select----</option>
   
   <?php
$selquery="select * from  tbl_district";
$result=$con->query($selquery);

while($data = $result -> fetch_assoc())
{

	?>
<option value="<?php echo $data["district_id"]?>"><?php echo $data["district_name"] ?></option>

<?php
}
?>
</select>
</tr>
  <tr>
   <td>Place</td>
   <td>

   <select name="sel_place" id="sel_place">
   <option value="-----select-----">---select----</option>
   </td>
</select>
</tr>
<tr>
      
      <td>Photo</td>
      <td><label for="photo"></label>
      <input type="file" name="filephoto" id="filephoto" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="proof"></label>
      <input type="file" name="fileproof" id="fileproof" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />        <input type="submit" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/Ajax/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

</script>