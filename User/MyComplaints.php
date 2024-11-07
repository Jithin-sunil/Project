<?php
include('Head.php');
include('../Assets/connection/connection.php');
if(isset($_GET['delID'])) {
    $delqry="delete from tbl_complaint where complaint_id='".$_GET['delID']."'";
    if($con->query($delqry)) {
        ?>
        <script>
        alert('Deleted');
        window.location="Complaint.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Reply</th>
                <th>Date</th>
                <th>Product</th>
                <th>Action</th>
            </tr>
            <?php
                $i=0;
                $sel="select * from tbl_complaint c inner join tbl_product p on c.product_id=p.product_id where c.user_id='".$_SESSION['userid']."'";
                $row=$con->query($sel);
                while($data=$row->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['complaint_title'] ?></td>
                        <td><?php echo $data['complaint_description'] ?></td>
                        <td><?php if($data['complaint_status']==0)
                        {
                            echo "Not Replied";
                        } 
                        else
                        {
                            echo $data['complaint_reply'];
                        }?></td>
                        <td><?php echo $data['complaint_date'] ?></td>
                        <td><?php echo $data['product_name'] ?></td>
                        <td><a href="Complaint.php?delID=<?php echo $data['complaint_id']?>">Delete</a></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
</body>
</html>
<?php   
include("Foot.ph");
?>