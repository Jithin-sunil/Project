 <?php

include('../Assets/Connection/Connection.php');
include('Header.php');

if(isset($_POST['ADD']))
{
	$STOCK=$_POST['txtstock'];
	$Mobile=$_GET['mid'];
	
$insQry="insert into tbl_stock(stock_quantity,mobile_id,stock_date)values('$STOCK','$Mobile',curdate())";
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
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td width="74" scope="col">Stock</td>
      <td width="110" scope="col"><label for="txtstock"></label>
      <input type="text" name="txtstock" id="txtstock" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="ADD" id="ADD" value="ADD" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
include('Footer.php');
?>