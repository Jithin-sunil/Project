
<?php
include('Head.php');
include('../Assets/connection/connection.php');

if (isset($_POST["btn_reg"])) {
    $Name = $con->real_escape_string($_POST["txt_name"]);
    $Email = $con->real_escape_string($_POST["txt_Email"]);
    $Password = password_hash($_POST["txt_Password"], PASSWORD_DEFAULT);
    
    $insqry = "INSERT INTO tbl_admin (admin_name, admin_email, admin_password) VALUES ('$Name', '$Email', '$Password')";
    
    if ($con->query($insqry)) {
        ?>
        <script>
            alert('Inserted');
            window.location = "Adminreg.php";
        </script>
        <?php
    }
}

if (isset($_GET["delID"])) {
    $delID = $con->real_escape_string($_GET["delID"]);
    $delqry = "DELETE FROM tbl_admin WHERE admin_id='$delID'";
    
    if ($con->query($delqry)) {
        ?>
        <script>
            alert('Deleted');
            window.location = "Adminreg.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Registration</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
        <tr>
            <td>Name</td>
            <td><input type="text" name="txt_name" id="txt_name" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="txt_Email" id="txt_Email" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="txt_Password" id="txt_Password" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="btn_reg" id="btn_reg" value="Register" /></td>
        </tr>
    </table>
    <p>&nbsp;</p>

    <table width="200" border="1">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Email</td>
            <td>Password</td>
            <td>Action</td>
        </tr>
        <?php
        $i = 0;
        $sel = "SELECT * FROM tbl_admin";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($data['admin_name']); ?></td>
                <td><?php echo htmlspecialchars($data['admin_email']); ?></td>
                <td><?php echo htmlspecialchars($data['admin_password']); ?></td>
                <td><a href="AdminRegistration.php?delID=<?php echo $data['admin_id']; ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</form>
</body>
</html>
<?php
include('Foot.php');
?>
