<?php
include('Head.php');
include('../Assets/connection/connection.php');

if (isset($_POST["btn_submit"])) {
    $Name = $_POST["txt_name"];
    $Price = $_POST["txt_price"];
    $Description = $_POST["txt_description"];
    $Photo = $_FILES["file_photo"]["name"];
    $temp = $_FILES["file_photo"]["tmp_name"];
    move_uploaded_file($temp, "../Assets/File/Product/" . $Photo);

    $Subcategory = $_POST["sel_subcategory"];
    $insqry = "INSERT INTO tbl_product(product_name, product_price, product_description, product_photo, subcategory_id, seller_id) 
               VALUES ('{$Name}', '{$Price}', '{$Description}', '{$Photo}', '{$Subcategory}', '{$_SESSION['sellerid']}')";

    if ($con->query($insqry)) {
        echo "<script>
                alert('Inserted');
                window.location='Product.php';
              </script>";
    }
}

if (isset($_GET['delID'])) {
    $delqry = "DELETE FROM tbl_product WHERE product_id='" . $_GET['delID'] . "'";
    if ($con->query($delqry)) {
        echo "<script>
                alert('Deleted');
                window.location='Product.php';
              </script>";
    }
}

if (isset($_GET['editid'])) {
    $selqry = "SELECT * FROM tbl_product WHERE product_id='" . $_GET['editid'] . "'";
    $r = $con->query($selqry);
    if ($d = $r->fetch_assoc()) {
        $eid = $d['product_id'];
        $ename = $d['product_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
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
            /* display: flex;
            justify-content: center;
            align-items: center; */
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

        table tr {
            margin-bottom: 15px;
        }

        table td {
            padding: 10px 0;
            vertical-align: top;
        }

        table td:first-child {
            text-align: right;
            padding-right: 20px;
            font-weight: 500;
            color: #555;
        }

        table td:last-child {
            font-size: 14px;
            color: #333;
        }

        img {
            display: block;
            margin: 0 auto;
            border-radius: 5px;
        }

        .profile-actions {
            text-align: center;
            margin-top: 20px;
        }

        .profile-actions a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #ffcc80;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .profile-actions a:hover {
            background-color: #ffa726;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Product Management</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="txt_name" id="txt_name" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required /></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="txt_price" id="txt_price" required /></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="txt_description" id="txt_description" required /></td>
                </tr>
                <tr>
                    <td>Photo:</td>
                    <td><input type="file" name="file_photo" id="file_photo" required /></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="sel_category" id="sel_category" onChange="getSubcategory(this.value)" required>
                            <option>--select--</option>
                            <?php
                            $sel = "SELECT * FROM tbl_category";
                            $row = $con->query($sel);
                            while ($data = $row->fetch_assoc()) {
                                echo "<option value='{$data['category_id']}'>{$data['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Subcategory:</td>
                    <td>
                        <select name="sel_subcategory" id="sel_subcategory" required>
                            <option>--select--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="profile-actions">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>

        <table width="100%" border="1" style="margin-top: 20px;">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $sel = "SELECT * FROM tbl_product p 
                    INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
                    INNER JOIN tbl_category c ON s.category_id = c.category_id";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
                echo "<tr>
                        <td>{$i}</td>
                        <td>{$data['product_name']}</td>
                        <td>{$data['product_price']}</td>
                        <td>{$data['product_description']}</td>
                        <td><img src='../Assets/File/Product/{$data['product_photo']}' width='150px' height='100px'/></td>
                        <td>{$data['category_name']}</td>
                        <td>{$data['subcategory_name']}</td>
                        <td>
                            <a href='Product.php?editid={$data['product_id']}'>Edit</a> |
                            <a href='Product.php?delID={$data['product_id']}'>Delete</a> |
                            <a href='Gallery.php?gid={$data['product_id']}'>Add Gallery</a> |
                            <a href='Stock.php?sid={$data['product_id']}'>Add Stock</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getSubcategory(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
                success: function(result) {
                    $("#sel_subcategory").html(result);
                }
            });
        }
    </script>
</body>
</html>

<?php
include('Foot.php');
?>
