<?php
include("../Assets/Connection/Connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>#</td>
            <td>Chat</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        <?php
        $selChat="select * from tbl_chatlist where from_id='".$_SESSION['uid']."' or to_id='".$_SESSION['uid']."'";
        $res=$con->query($selChat);
        $i=0;
                while($data=$res->fetch_assoc())
                {
                    $i++;
                    if($data['chat_type'] == 'USER'){
                        $selUser="select * from tbl_user where user_id =".$data['from_id'];
                        $resUser=$con->query($selUser);
                        $rowUser=$resUser->fetch_assoc();
                    }
                    else{
                        $selUser="select * from tbl_user where user_id =".$data['to_id'];
                        $resUser=$con->query($selUser);
                        $rowUser=$resUser->fetch_assoc();
                    }
                    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><p><?php echo $rowUser['user_name'] ?></p>
            <p><?php echo $data['chat_content'] ?></p>
        </td>
            <td>
                <?php
               
                echo $data['chat_datetime'] ?>
            </td>
            <td>
                <a href="Chat.php?id=<?php echo $rowUser['user_id'] ?>">Chat</a>
            </td>
        </tr>
        <?php
                }
                ?>
    </table>
</body>
</html>