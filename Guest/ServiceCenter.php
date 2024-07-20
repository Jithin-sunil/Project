<?php

include('../Assets/Connection/Connection.php');

if(isset($_POST['btnreg']))
{

	

	
	$name=$_POST['txtname'];
	$Email=$_POST['email'];
	$Password=$_POST['txtpass'];
	$contact=$_POST['txtcontact'];
	$address=$_POST['txtaddress'];
	$photo=$_FILES['filephoto']['name'];
	$temp=$_FILES['filephoto']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/ServicecenterDocs/'.$photo);
	
    $proof=$_FILES['fileproof']['name'];
	$temps=$_FILES['fileproof']['tmp_name'];
	move_uploaded_file($temps,'../Assets/Files/ServicecenterDocs/'.$proof);
		
	$district=$_POST['selDistrict'];
	$place=$_POST['sel_place'];
	

	

	
	
	$insQry="insert into tbl_servicecenter(servicecenter_photo,servicecenter_name,servicecenter_email,servicecenter_password,servicecenter_contact,servicecenter_address,servicecenter_proof,place_id)
	values('$photo','$name','$Email','$Password','$contact','$address','$proof','$place')";
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
  <table width="200" border="1">
  
      <td>Photo</td>
      <td>
        <label for="filephoto"></label>
        <input type="file" name="filephoto" id="filephoto" /></td>
    </tr>
      
    <tr>
      <td width="94" scope="col">Name</td>
      <td width="90" scope="col"><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="email"></label>
      <input type="text" name="email" id="email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txtpass"></label>
      <input type="text" name="txtpass" id="txtpass" /></td>
    </tr>
     <tr>
      <td>Contact</td>
      <td><label for="txtcontact"></label>
      <input type="text" name="txtcontact" id="txtcontact" /></td>
    </tr>
     <tr>
      <td>Address</td>
      <td><label for="txtaddress"></label>
      <input type="text" name="txtaddress" id="txtaddress" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="fileproof"></label>
      <input type="file" name="fileproof" id="fileproof" />        </td>
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
</td>
</tr>
   <tr>
   <td>Place</td>
   
   <td>
   <select name="sel_place" id="sel_place">
   <option value="-----select-----">---select----</option>
   
   
</select>
</tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnreg" id="btnreg" value="Register" /></td>
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
