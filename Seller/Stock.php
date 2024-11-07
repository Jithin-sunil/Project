<?php
include('Head.php');
include('../Assets/connection/connection.php');

if (isset($_POST["btn_submit"])) {
    $qty = $_POST["txt_qty"];
    
    $insqry = "insert into tbl_stock(stock_quantity, stock_date, product_id) values('".$qty."', curdate(), '".$_GET['sid']."')";
    if ($con->query($insqry)) {
        ?>
        <script>
            alert('Inserted');
            window.location = "Stock.php";
        </script>
        <?php
    }
}

if (isset($_GET['id'])) {
    $del = "delete from tbl_stock where stock_id='".$_GET['id']."'";
    if ($con->query($del)) {
        ?>
        <script>
            alert('Deleted');
            window.location = 'Product.php';
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
    <title>Stock Management</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
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

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #ffcc80;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ffa726;
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Stock</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Stock Quantity:</td>
                    <td><input type="text" name="txt_qty" id="txt_qty" placeholder="Enter quantity" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>

        <h2>Stock List</h2>
        <table>
            <tr>
                <th>#</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_stock where product_id='".$_GET['sid']."'";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['stock_quantity'] ?></td>
                <td><?php echo $data['stock_date'] ?></td>
                <td><a href="Stock.php?id=<?php echo $data['stock_id']?>">Delete</a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
include('Foot.php');
?>
