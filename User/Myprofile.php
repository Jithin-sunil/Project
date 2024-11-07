<?php
include('Head.php');
include("../Assets/connection/connection.php");

$selqry = "select * from tbl_user u 
           inner join tbl_place p on u.place_id=p.place_id 
           inner join tbl_district d on d.district_id=p.district_id 
           where user_id='" . $_SESSION['userid'] . "'";
$row = $con->query($selqry);
$data = $row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        <h2>User Profile</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td colspan="2">
                        <img src="../Assets/File/User/Photo/<?php echo $data['user_photo']; ?>" width="150px" height="160px" alt="User Photo" />
                    </td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><?php echo $data['user_name']; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $data['user_email']; ?></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><?php echo $data['user_contact']; ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo $data['user_address']; ?></td>
                </tr>
                <tr>
                    <td>District:</td>
                    <td><?php echo $data['district_name']; ?></td>
                </tr>
                <tr>
                    <td>Place:</td>
                    <td><?php echo $data['place_name']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="profile-actions">
                        <a href="Editprofile.php">Edit Profile</a>
                        <a href="Changepassword.php">Change Password</a>
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
