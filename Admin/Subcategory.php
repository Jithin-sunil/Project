<?php
include('Head.php');
include("../Assets/connection/connection.php");
if (isset($_POST["btn_submit"])) {
    $category = $_POST["sel_category"];
    $subcategory = $_POST["txt_sub"];
    $insqry = "insert into tbl_subcategory(category_id, subcategory_name) values('".$category."', '".$subcategory."')";
    if ($con->query($insqry)) {
        ?>
        <script>
        alert('Inserted');
        window.location = 'Subcategory.php';
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
    <title>Add Subcategory</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        td {
            padding: 10px;
            color: #555;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        input[type="submit"] {
            width: 120px;
            padding: 10px;
            background-color: #4CAF50; /* Green */
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .center-btn {
            text-align: center;
        }

        .btn-cancel {
            background-color: #f44336; /* Red */
        }

        input[type="submit"].btn-cancel:hover {
            background-color: #d32f2f;
        }

        .table-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-list th, .table-list td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table-list th {
            background-color: #f2f2f2;
        }

        .table-list tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Subcategory</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="sel_category" id="sel_category">
                            <option>--select--</option>
                            <?php
                            $sel = "select * from tbl_category";
                            $row = $con->query($sel);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $data['category_id'] ?>">
                                    <?php echo $data['category_name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Subcategory name</td>
                    <td><input type="text" name="txt_sub" id="txt_sub" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" value="Submit" />
                        <input type="submit" name="btn_cancel" class="btn-cancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </form>

        <table class="table-list">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['category_name'] ?></td>
                <td><?php echo $data['subcategory_name'] ?></td>
                <td><!-- Add actions like Edit/Delete here --></td>
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
