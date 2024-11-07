<?php
include('Head.php');
include("../Assets/connection/connection.php");


$sel = "SELECT * FROM tbl_user WHERE user_id='" . $_SESSION['userid'] . "'";
$row = $con->query($sel);
$data = $row->fetch_assoc();

if (isset($_POST["btn_submit"])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['textarea'];
    
    $upqry = "UPDATE tbl_user SET user_name='" . $name . "', user_email='" . $email . "', user_contact='" . $contact . "', user_address='" . $address . "' WHERE user_id='" . $_SESSION['userid'] . "'";
    
    if ($con->query($upqry)) {
        echo "<script>
                alert('Updated');
                window.location='Editprofile.php';
              </script>";
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

        table td:last-child input,
        table td:last-child textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: none;
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
            width: 100%;
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
                    <td><input type="text" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($data['user_name']); ?>" pattern="^[A-Z][a-zA-Z\s]*$" title="Name must start with a capital letter and only contain alphabets and spaces." required /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="txt_email" id="txt_email" value="<?php echo htmlspecialchars($data['user_email']); ?>" required /></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" name="txt_contact" id="txt_contact" value="<?php echo htmlspecialchars($data['user_contact']); ?>" pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 followed by 9 digits." required /></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><textarea name="textarea" id="textarea" cols="45" rows="5" required><?php echo htmlspecialchars($data['user_address']); ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Edit" />
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
