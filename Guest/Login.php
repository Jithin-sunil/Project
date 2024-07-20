<?php
include('../Assets/Connection/Connection.php');
session_start();
if(isset($_POST["btnlogin"]))
{
	$email=$_POST["txtemail"];
	$password=$_POST["txtpassword"];
	$SelUser="select * from tbl_user where user_email='$email' and user_password='$password'";
	$user=$con->query($SelUser);
	
	$SELAdmin="select * from tbl_admin where admin_email='$email' and admin_password='$password'";
	$admin=$con->query($SELAdmin);
	
	$company="select * from tbl_company where company_email='$email' and company_password='$password' ";
	$companydata=$con->query($company);
	
	$SELservicecenter="select * from tbl_servicecenter where servicecenter_email='$email' and servicecenter_password='$password' ";
	$servicecenter=$con->query($SELservicecenter);
	
	
	

	if ($datauser = $user->fetch_assoc())
	{
		$_SESSION["uid"]=$datauser["user_id"];
		$_SESSION["uname"]=$datauser["user_name"];		
		header('Location:../User/Homepage.php');
	}
	else if($dataadmin=$admin->fetch_assoc())
	{
		$_SESSION["admin_id"]=$dataadmin["admin_id"];
		$_SESSION["admin_name"]=$dataadmin["admin_name"];		
		header('Location:../Admin/Homepage.php');
	}
	else if($datacompany=$companydata->fetch_assoc())
	{
		$_SESSION["company_id"]=$datacompany["company_id"];
		$_SESSION["company_name"]=$datacompany["company_name"];		
		header('Location:../Company/Homepage.php');
	}
	else if($dataservicecenter=$servicecenter->fetch_assoc()) 
	{
		if($dataservicecenter['center_status']==1)
		{
			$_SESSION["sid"]=$dataservicecenter["servicecenter_id"];
		$_SESSION["servicecenter_name"]=$dataservicecenter["servicecenter_name"];		
		header('Location:../ServiceCenter/Homepage.php');
		}
		elseif($dataservicecenter['center_status']==2)
		{
			?>
            <script>
            alert("Your Request has been Rejected by the Admin")
            </script>
            <?php
		}
		elseif($dataservicecenter['center_status']==0	){
			?>
            <script>
            alert("Your Request is Pending")
            </script>
            <?php
		}
		
	}
	
	else
	{
		?>
        <script>
		alert("Invalid Details")
		</script>
        <?php
	}
}
?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin/User:Homepage.php</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="276" height="120" border="1">
    <tr>
      <td>Email</td>
      <td><label for="txtemail"></label>
      <input type="text" name="txtemail" id="txtemail" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txtpassword"></label>
      <input type="text" name="txtpassword" id="txtpassword" /></td>
    </tr>
    <tr>
      <td colspan="2" align=""><input type="submit" name="btnlogin" id="btnlogin" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>
