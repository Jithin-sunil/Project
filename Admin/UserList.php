
<?php
include('../Assets/Connection/Connection.php');




if(isset($_GET["delID"]))
{
	$userID=$_GET["delID"];
	$delQry="delete from tbl_user where user_id=$userID";
    if($con -> query($delQry))
	{
		echo"deleted";
		header("location:UserList.php");
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

    <table width="386" height="140" border="1">
  <tr>
    <td>SLNO</td>
    <td>Placename</td>
    <td>Pincode</td>
    <td>District</td>
    <td>Photo</td>
    <td>Proof</td>
    <td>Name</td>
    <td>Gender</td>
    <td>Contact</td>
    <td>Email</td>
    <td>Action</td>
  </tr>
<?php
               $selquery="select * from tbl_user u inner join  tbl_place p on u.place_id=p.place_id inner join tbl_district d on                p.district_id=d.district_id";
               $result=$con->query($selquery);
               $i=0;
     while($data = $result -> fetch_assoc())
  {
	   $i++;
	   ?>
    <tr>
                <td><?php echo $i?></td>
	            <td><?php echo $data ["place_name"] ?></td>
                <td><?php echo $data ["place_pincode"] ?></td>
                <td><?php echo $data ["district_name"] ?></td>
                <td><img src="../Assets/Files/UserDocs/<?php echo $data ["user_photo"] ?>" width="50" height="50" /></td>
                <td><img src="../Assets/Files/UserDocs/<?php echo $data ["user_proof"] ?>" width="50" height="50" /></td>
                <td><?php echo $data ["user_name"] ?></td>
                <td><?php echo $data ["user_gender"] ?></td>
                <td><?php echo $data ["user_contact"] ?></td>
                <td><?php echo $data ["user_email"] ?></td>
        
        
                <td><a href="UserList.php?delID=<?php echo $data["user_id"]?>">DELETE</a></td>
    </tr> 
   
    <?php
}
?>
</table>
</form>
</body>
</html>
