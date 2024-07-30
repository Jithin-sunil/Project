<?php
include('../Assets/Connection/Connection.php');
include('Header.php');

?>


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <td width="55">Seller Name</td>
            <td width="44">Photo</td>
            <td width="44">Status</td>

        </tr>
        <tr>
            <?php
		$selqurey="select * from tbl_buyusedphone b inner join tbl_usedphone u on b.usedphone_id=u.usedphone_id inner join tbl_user r on u.user_id=r.user_id where buyer_id=".$_SESSION['uid'];
		 $result=$con->query($selqurey);
        $i=0;
        while($data=$result->fetch_assoc())
		{
            $i++;
            ?>
        <tr>

            <td>
                <?php echo $data["usedphone_name"] ?>
            </td>
            <td>
                <?php echo $data["usedphone_price"]?>
            </td>
            <td>
                <?php echo $data["user_name"]?>
            </td>
            <td>
                <img src="../Assets/Files/UsedPhones/<?php echo $data["usedphone_photo"]?>" width="150" height="150" alt="">
            </td>

            <td>
                <?php 
                        if($data['buy_status']==0)
                        {
                            echo "Not Buyed";
                        }
                        else if($data['buy_status']==1)
                        {
                            echo "Booked";
                            ?>
                            <a href="">Chat</a>
                            <?php

                        }
                        else if($data['buy_status']==2)
                        {
                            ?>
                            <a href="">Selled Phone</a>
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