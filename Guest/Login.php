<?php
include("../Assets/connection/connection.php");
session_start();

if (isset($_POST["btn_login"])) {
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];

    $selqry = "select * from tbl_user where user_email='" . $email . "' and user_password='" . $password . "'";
    $row = $con->query($selqry);
    $sel1 = "select * from tbl_seller where seller_email='" . $email . "' and seller_password='" . $password . "'";
    $row1 = $con->query($sel1);
    $sel2 = "select * from tbl_admin where admin_email='" . $email . "' and admin_password='" . $password . "'";
    $row2 = $con->query($sel2);

    if ($data = $row->fetch_assoc()) {
        $_SESSION['userid'] = $data['user_id'];
        $_SESSION['username'] = $data['user_name'];
        header("location:../User/Homepage.php");
    } elseif ($data = $row1->fetch_assoc()) {
        $_SESSION['sellerid'] = $data['seller_id'];
        $_SESSION['sellername'] = $data['seller_name'];
        header("location:../seller/Homepage.php");
    }elseif ($data = $row2->fetch_assoc()) {
        $_SESSION['adminid'] = $data['admin_id'];
        $_SESSION['adminname'] = $data['admin_name'];
        header("location:../Admin/Homepage.php");
    } else {
        echo "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            width: 400px;
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
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #ffa726; /* Darker Orange on hover */
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #ff7043;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .center-content a {
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Login</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="txt_email" id="txt_email" placeholder="Enter your email" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="txt_password" id="txt_password" placeholder="Enter your password" /></td>
                </tr>
            </table>

            <div class="center-content">
                <input type="submit" name="btn_login" id="btn_login" value="Login" />

                <a href="Newuser.php">New User</a>
				<a href="SellerRegistration.php">New Seller</a>
            </div>
        </form>
    </div>

</body>

</html>
