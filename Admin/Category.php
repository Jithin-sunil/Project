<?php
include('Head.php');
include('../Assets/connection/connection.php');

if (isset($_POST["btn_submit"])) {
    $Category = $_POST["txt_category"];
    $insqry = "insert into tbl_category(category_name) values ('" . $Category . "')";
    if ($con->query($insqry)) {
?>
        <script>
            alert('Inserted');
            window.location = "category.php";
        </script>
<?php
    }
}

if (isset($_GET["delID"])) {
    $delQry = "delete from tbl_category where category_id='" . $_GET["delID"] . "'";
    if ($con->query($delQry)) {
        echo "Deleted";
        header("location:Category.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
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
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 600px;
            margin-bottom: 30px;
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
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
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
            color: #ff7043; /* Light Orange */
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            text-decoration: underline;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #ffcc80; /* Light Orange */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ffa726; /* Darker Orange on hover */
        }

        .center-btn {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Add Category</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Category Name</td>
                    <td>
                        <input type="text" name="txt_category" id="txt_category" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="container">
        <h2>Category List</h2>
        <form id="form2" name="form2" method="post" action="">
            <table>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                $sel = "select * from tbl_category";
                $row = $con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['category_name'] ?></td>
                        <td><a href="category.php?delID=<?php echo $data['category_id'] ?>">Delete</a></td>
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
