<?php

include('../Assets/Connection/Connection.php');

if(isset($_POST['btnsubmit'])!=null)
{
	$name=$_POST['txtname'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$contact=$_POST['txtcontact'];
	$address=$_POST['txtaddress'];
	
	$place=$_POST['sel_place'];
	
	$photo=$_FILES['photo']['name'];
	$temp=$_FILES['photo']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/CompanyDocs/'.$photo);
	
	
	$proof=$_FILES['proof']['name'];
	$temp=$_FILES['proof']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/CompanyDocs/'.$proof);
	
	
	$insQry="insert into tbl_company(company_name,company_email,company_password,company_proof,company_photo,company_address,place_id,company_contact)
	values('$name','$email','$password','$proof','$photo','$address','$place','$contact')";
	
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
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="256" border="1">
    <tr>
      <td width="164" scope="col">Name</td>
      <td><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail" /></td>
    </tr>
     <tr>
      <td>Contact</td>
      <td><label for="contact"></label>
        <label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" /><label for="contact"></label></td>
    </tr>
    <tr>
    <tr>
    
      <td>Password</td>
      <td><label for="txtpassword"></label>
      <input type="password" name="txtpassword" id="txtpassword" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="proof"></label>
      <input type="file" name="proof" id="proof" />  <label for="fileproof"></label></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="proof"></label>
      <input type="file" name="photo" id="photo" />  </td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="address"></label>
      <textarea name="txtaddress" cols="10" rows="5"></textarea> </td>
    </tr>
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
   
   
</select>
</tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      <input type="submit" name="btncancel" id="btncancel" value="Cancel" /></td>
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