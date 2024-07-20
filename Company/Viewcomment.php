<?php

include('../Assets/Connection/Connection.php');
include('Header.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mobile Details</title>
</head>
<table border="1" align="center">
<tr>
<td>Mobile</td>
<td>UserName</td>
<td>Email</td>
<td>Date</td>
<td>Comment</td>
</tr>

<?php
$selquery="select * from  tbl_comment c inner join tbl_user u on c.user_id=u.user_id inner join tbl_mobile m on c.mobile_id=m.mobile_id";
$result=$con->query($selquery);

while($data = $result -> fetch_assoc())
{

?>
<tr>
<td><?php echo $data["mobile_name"] ?></td>
<td><?php echo $data["user_name"] ?></td>
<td><?php echo $data["user_email"] ?></td>
<td><?php echo $data["comment_date"] ?></td>
<td><?php echo $data["comment_comment"] ?></td>
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



