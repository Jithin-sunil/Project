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

<body>
<a href="Homepage.php">Home</a>
<table width="666" height="161" border="1">
<tr>
		
        <td width="33">Product Name</td>
		<td width="55">Price</td>
        <td width="55">Quatity</td>
        <td width="44">Booking Date</td>
        <td width="44">Status</td>
        
        </tr>
        <tr>
		 <?php
		$selqurey="select * from tbl_cart r  inner join tbl_mobiledetails c on r.product_id=c.mobiledetails_id inner join tbl_booking o on r.booking_id=o.booking_id where user_id='".$_SESSION['uid']."' " ;
		 $result=$con->query($selqurey);
        $i=0;
        while($data=$result->fetch_assoc())
		{
            $i++;
            ?>
            <tr>
       
            <td><?php echo $data["mobiledetails_name"]?></td>
            <td><?php echo $data["mobiledetails_price"]?></td>
            <td><?php echo $data["cart_quantity"]?></td>
             <td><?php echo $data["booking_date"]?></td>
           
             <td><?php 
					if($data["booking_status"]==1 && $data["cart_status"]==1)
					{
						echo "payment pending....";
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==1)
					{
						
						?>
                        payment completed /
                        <!-- <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=3">Pack product</a> -->
                        <?php 
					}
					else if($data["booking_status"]==2  && $data["cart_status"]==3)
					{
						?>
                        product packed /
                        <!-- <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=4">Ship Product</a> -->
                        <?php 
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==4)
					{
						?>
                        product shipped /
                        <!-- <a href="Viewuserbooking.php?cid=<?php echo $data ["cart_id"];?>&sts=5">Product Delivered</a> -->
                        <?php 
					}
					else if($data["booking_status"]==2 && $data["cart_status"]==5)
					{
						?>
                       Order Completed 
					   <a href="Rating.php?pid=<?php echo $data['product_id']?>">Rating</a>
                        <?php 
					}
					?>
			</td>
            </tr>
            <?php
            } 
            ?> 
            
            
            </table>
		
</body>

</html>