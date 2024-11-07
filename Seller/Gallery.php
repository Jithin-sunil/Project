<?php
include('Head.php');
include("../Assets/connection/connection.php");

if (isset($_POST["btn_submit"])) {
    $photo = $_FILES["file_image"]["name"];
    $temp = $_FILES["file_image"]["tmp_name"];
    move_uploaded_file($temp, "../Assets/File/Product/" . $photo);

    $insqry = "INSERT INTO tbl_gallery(gallery_image, product_id) VALUES ('" . $photo . "', '" . $_GET['gid'] . "')";
    if ($con->query($insqry)) {
        ?>
        <script>
            alert('Inserted');
            window.location = 'Gallery.php';
        </script>
        <?php
    }
}

if (isset($_GET['delID'])) {
    $del = "DELETE FROM tbl_gallery WHERE gallery_id='" . $_GET['delID'] . "'";
    if ($con->query($del)) {
        ?>
        <script>
            alert('Deleted');
            window.location = 'Gallery.php';
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Gallery Management</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f9fc;
            /* display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px; */
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table tr {
            margin-bottom: 15px;
        }

        table td {
            padding: 10px;
            vertical-align: middle;
            border: 1px solid #ccc;
        }

        input[type="file"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ffcc80; /* Light Orange */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ffa726; /* Darker Orange on hover */
        }

        img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        a {
            color: #d32f2f;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Gallery Management</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="file_image" id="file_image" required /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
        
        <h2>Uploaded Images</h2>
        <table>
            <tr>
                <td>#</td>
                <td>Image</td>
                <td>Action</td>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_gallery WHERE product_id='". $_GET['gid'] ."'";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><img src="../Assets/File/Product/<?php echo $data['gallery_image'] ?>" alt="Gallery Image" /></td>
                    <td><a href="Gallery.php?delID=<?php echo $data['gallery_id'] ?>">Delete</a></td>
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
