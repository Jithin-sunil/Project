<?php
include('../Assets/Connection/Connection.php');
include('Header.php');

$selquery="select * from tbl_company u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id	 where company_id='".$_SESSION['company_id']."'";
$row=$con->query($selquery);
$data=$row->fetch_assoc()



?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="423" height="437" border="1">
   <tr>
   <td><img src="../Assets/Files/CompanyDocs/<?php echo $data["company_photo"] ?>" width="90" height="50" /></td>
   </tr>
    <tr>
      <td width="153">Name</td>
     <td width="254"><?php echo $data["company_name"] ?></td>
    </tr>
    <tr>
      <td><p>Email</p></td>
       <td><?php echo $data["company_email"] ?></td>
    </tr>
    <tr>
      <td>Contact</td>
       <td><?php echo $data["company_contact"] ?></td>
       </tr>
       <tr>
      <td>Address</td>
       <td><?php echo $data["company_address"] ?></td>
    </tr>
   <tr>
     <td>District</td>
       <td><?php echo $data["district_name"] ?></td>
       </tr>
       <tr>
      <td>Place</td>
       <td><?php echo $data["place_name"] ?></td>
    </tr>
   
      <td colspan="2" align="center">
      <a href ="Editprofile.php">Editprofile</a>&nbsp;&nbsp;<a href ="Changepassword.php">Changepassword</a></td>
    </tr>
  </table>
</body>
</html>
<?php
include('Footer.php');
?>