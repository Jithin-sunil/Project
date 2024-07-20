<?php
include('../Assets/Connection/Connection.php');
include('Header.php');
if(isset($_GET["cid"]))

	{
		$upQry="update tbl_cart set cart_status='".$_GET["sts"]."' where cart_id='".$_GET["cid"]."' ";
		if($con->query($upQry))
		{
			?>
			<script>
			
			</script>
			<?php
		}
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mobile Details</title>
</head>
 <table border="1" align="center">
<tr>

<td>SLNO</td>
<td>UserName</td>
<td>Contact</td>
<td>Address</td>
<td>Mobile</td>
<td>Price</td>
<td>Status</td>


</tr>
<?php
$selquery="select * from tbl_booking b inner join tbl_cart c on b.booking_id=c.booking_id inner join tbl_mobiledetails m on c.product_id=m.mobiledetails_id inner join tbl_mobile mo on mo.mobile_id=m.mobile_id inner join tbl_user u on b.user_id=u.user_id where mo.company_id='".$_SESSION['company_id']."' ";
$result=$con->query($selquery);
$i=0;
while($data = $result -> fetch_assoc())
{ 
	$i++;
	?>
    <tr>
    <td><?php echo $i?></td>
   
	<td><?php echo $data["user_name"] ?></td>
    <td><?php echo $data["user_contact"] ?></td>
    <td><?php echo $data["user_address"] ?></td>
    <td><?php echo $data["mobiledetails_name"] ?></td>
    <td><?php echo $data["mobiledetails_price"] ?></td>
    <td>
    <?php 
					if($data["booking_status"]==1 && $data["cart_status"]==1)
					{
						echo "payment pending....";
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==1)
					{
						
						?>
                        payment completed /
                        <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=3">Pack product</a>
                        <?php 
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==3)
					{
						?>
                        product packed /
                        <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=4">Ship Product</a>
                        <?php 
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==4)
					{
						?>
                        product shipped /
                        <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=5">Product Delivered</a>
                        <?php 
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==5)
					{
						?>
                       Order Completed
                        <?php 
					}
					?>
                    </td>
                    
				
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



