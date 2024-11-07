<?php
include('Head.php');
include("../Assets/connection/connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Table</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 1000px;
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        td {
            color: #555;
        }

        td a {
            color: #ff7043;
            /* Light Orange */
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            text-decoration: underline;
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Complaints</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Content</th>
                 
                    <th>Date</th>
                    <th>Product</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                $sel = "select * from tbl_complaint c 
                        inner join tbl_product p on p.product_id=c.product_id 
                        inner join tbl_user u on u.user_id=c.user_id 
                        where p.seller_id='" . $_SESSION['sellerid'] . "'";
                $row = $con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['user_name'] ?></td>
                        <td><?php echo $data['complaint_title'] ?></td>
                        <td><?php echo $data['complaint_description'] ?></td>
                       
                        <td><?php echo $data['complaint_date'] ?></td>
                        <td><?php echo $data['product_name'] ?></td>
                        <td>
                            <?php
                            if ($data['complaint_status'] == 1) {
                                echo $data['complaint_reply'];
                            } else {


                                ?>

                                <a href="Reply.php?cid=<?php echo $data['complaint_id'] ?>">Reply</a>
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
    </div>

</body>

</html>
<?php
include('Foot.php');
?>