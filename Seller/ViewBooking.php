<?php
include('Head.php');
include("../Assets/connection/connection.php");

if(isset(($_GET['bid'])))
{
    $up="update tbl_booking set booking_status='".$_GET['sts']." where booking_id='".$_GET['bid']."'";
    if($con->query($up))
    {
        echo "<script>window.location='ViewBooking.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Seller's View Booking</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #80c1ff; /* Light Blue */
            color: #333;
        }
        img {
            max-width: 150px;
            max-height: 100px;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table>
        <tr>
            <th>#</th>
            <th>Buyer Name</th>
            <th>Buyer Contact</th>
            <th>Product</th>
            <th>Price</th>
            <th>Photo</th>
            <th>Booking Status</th>
        </tr>
        <?php
        $i = 0;
        $seller_id = $_SESSION['sellerid']; // Assuming seller session is active
        
        // Query to fetch seller's products and buyer details
        $selQry = "SELECT * FROM tbl_cart c 
                    INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                    INNER JOIN tbl_product p ON p.product_id = c.product_id 
                    INNER JOIN tbl_user u ON u.user_id = b.user_id
                    WHERE p.seller_id = '$seller_id'";
        $row = $con->query($selQry);
        
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['user_name']; ?></td>
                <td><?php echo $data['user_contact']; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo $data['product_price']; ?></td>
                <td><img src="../Assets/File/product/<?php echo $data['product_photo']; ?>" /></td>
                <td>
                    <?php
                    if ($data['booking_status'] == 1) {
                        echo "Payment Pending";
                    } elseif ($data['booking_status'] == 2) {
                        echo "Payment Completed";
                        ?>
                        <a href="ViewBooking.php?bid=<?php echo $data['booking_id']?>&sts=3">Shipped</a>
                        <?php
                    } elseif ($data['booking_status'] == 3) {
                        echo "Shipped";
                        ?>
                        <a href="ViewBooking.php?bid=<?php echo $data['booking_id']?>&sts=4">Delivered</a>
                        <?php
                    } elseif ($data['booking_status'] == 4) {
                        echo "Delivered";
                        
                    } 
                    elseif ($data['booking_status'] == 5) {
                        echo "Booking Cancelled";
                        
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
<script>
function confirmCancellation() {
    return confirm("Are you sure you want to cancel this booking? Please note that 5% of the booking amount will be taken as a service charge.");
}
</script>
<?php
include('Foot.php');
?>
