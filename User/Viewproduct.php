<?php 
include('../Assets/connection/connection.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>Name</td>
      <td>Price</td>
      <td>Details</td>
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_product";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['product_name']?></td>
      <td><?php echo $data['product_price']?></td>
      <td><?php echo $data['product_description']?></td>
      <td><img src="../Assets/File/Product/<?php echo $data['product_photo']?>"width="150px" height="100px"/></td>
      <td></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>