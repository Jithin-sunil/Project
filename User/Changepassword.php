<?php
include('Head.php');
include("../Assets/connection/connection.php");

$selqry="select * from tbl_user where user_id='".$_SESSION['userid']."'";
$row=$con->query($selqry);
$data=$row->fetch_assoc();
$dbpassword=$data['user_password'];
if(isset($_POST["btn_submit"])) {
    $OldPassword=$_POST["txt_old"];
    $NewPassword=$_POST["txt_new"];
    $ReTypePassword=$_POST["txt_conform"];
    
    if($dbpassword == $OldPassword) {
        if($NewPassword == $ReTypePassword) {
            $upqry = "update tbl_user set user_password='" . $NewPassword . "' where user_id='" . $_SESSION['userid'] . "'";
            if($con->query($upqry)) {
                ?>
                <script>
                alert('Updated');
                window.location='Changepassword.php';
                </script>
                <?php
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
        <h2>Change Password</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Old Password:</td>
                    <td><input type="password" name="txt_old" id="txt_old"required /></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="txt_new" id="txt_new"required /></td>
                </tr>
                <tr>
                    <td>Re-Type Password:</td>
                    <td><input type="password" name="txt_conform" id="txt_conform" required/></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" />
                        <input type="button" name="txt_cancel" id="txt_cancel" value="Cancel" onclick="window.location='some_page.php'" />
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
