<?php
include('Head.php');
include('../Assets/connection/connection.php');

if(isset($_POST['btn_submit'])) {
    $product=$_GET['pid'];
    $insqry="insert into tbl_complaint(complaint_title,complaint_description,complaint_date, product_id,user_id)values('".$_POST['txt_title']."','".$_POST['txt_content']."',curdate(),'".$product."','".$_SESSION['userid']."')";
    if($con->query($insqry)) {
        ?>
        <script>
        alert('Complaint posted');
        window.location="Complaint.php";
        </script>
        <?php
    }
}
if(isset($_GET['delID'])) {
    $delqry="delete from tbl_complaint where complaint_id='".$_GET['delID']."'";
    if($con->query($delqry)) {
        ?>
        <script>
        alert('Deleted');
        window.location="Complaint.php";
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
    <title>Complaint Submission</title>
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
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
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

        table tr {
            margin-bottom: 15px;
        }

        table td {
            padding: 10px;
            vertical-align: top;
        }

        table td:first-child {
            text-align: right;
            padding-right: 20px;
            font-weight: 500;
            color: #555;
        }

        table input[type="text"],
        table textarea {
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
        }

        input[type="submit"]:hover {
            background-color: #ffa726; /* Darker Orange on hover */
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }

        th {
            background-color: #ffcc80;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
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
        <h2>Complaint Submission</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="txt_title" id="txt_title" placeholder="Enter the complaint title" required />
                    </td>
                </tr>
                <tr>
                    <td>Content:</td>
                    <td>
                        <textarea name="txt_content" id="txt_content" cols="45" rows="5" placeholder="Enter the complaint content" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>

        <h2>Your Complaints</h2>
        <table>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Reply</th>
                <th>Date</th>
                <th>Product</th>
                <th>Action</th>
            </tr>
            <?php
                $i=0;
                $sel="select * from tbl_complaint c inner join tbl_product p on c.product_id=p.product_id where c.user_id='".$_SESSION['userid']."'";
                $row=$con->query($sel);
                while($data=$row->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['complaint_title'] ?></td>
                        <td><?php echo $data['complaint_description'] ?></td>
                        <td><?php if($data['complaint_status']==0)
                        {
                            echo "Not Replied";
                        } 
                        else
                        {
                            echo $data['complaint_reply'];
                        }?></td>
                        <td><?php echo $data['complaint_date'] ?></td>
                        <td><?php echo $data['product_name'] ?></td>
                        <td><a href="Complaint.php?delID=<?php echo $data['complaint_id']?>">Delete</a></td>
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
