<?php
include('../Assets/Connection/Connection.php');
include('Header.php');

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<table width="386" height="140" border="1">
  <tr>
    <td>SLNO</td>
      <td>Mobile Name</td>
       <td>Details</td>
       <td>Price</td>
       <td>Mobile booking</td>
<?php
$selquery="select * from tbl_usedphone";
$result=$con->query($selquery);
$i=0;
while($data = $result -> fetch_assoc())
{
	$i++;
	?>
    <tr>
    <td><?php echo $i?></td>
    <td><img src="../Assets/Files/UsedPhones/<?php echo $data["usedphone_photo"] ?>" width="150" height="150" alt=""></td>
	<td><?php echo $data["usedphone_name"] ?></td>
    <td><?php echo $data["usedphone_details"] ?></td>
    <td><?php echo $data["usedphone_price"] ?></td>
 <td><a href="ViewUsedPhone.php?bookID=<?php echo $data["usedphone_id"]?>">BOOKING</a></td>

    </tr> 
   
    <?php
}
?>
</table>
</form>

</body>
</html>
<?php
include('Footer.php');
?>