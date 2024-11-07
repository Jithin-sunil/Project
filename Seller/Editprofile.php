<?php
include('Head.php');
include("../Assets/connection/connection.php");
$sel = "select * from tbl_seller where seller_id='" . $_SESSION['sellerid'] . "'";
$row = $con->query($sel);
$data = $row->fetch_assoc();
if (isset($_POST["btn_edit"])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];

    $upqry = "update tbl_seller set seller_name='" . $name . "',seller_email='" . $email . "',seller_contact='" . $contact . "' where seller_id='" . $_SESSION['sellerid'] . "'";
    if ($con->query($upqry)) {
        ?>
        <script>
            alert('updated');
            window.location = "Editprofile.php";
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
    <title>Edit Profile</title>
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

        table td:last-child input {
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
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Edit Profile</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="txt_name" id="txt_name" value="<?php echo $data['seller_name']; ?>"title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"required /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="txt_email" id="txt_email" value="<?php echo $data['seller_email']; ?>" required/></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['seller_contact']; ?>" pattern="[7-9]{1}[0-9]{9}" 
                title="Phone number with 7-9 and remaing 9 digit with 0-9"required /></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_edit" id="btn_edit" value="Edit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>
<?php
include('Foot.php');
?>
