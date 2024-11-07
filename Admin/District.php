<?php
include('Head.php');
include("../Assets/connection/connection.php");
$eid=0;
$ename="";
if(isset($_POST["btn_submit"]))
{
    $district=$_POST["txt_name"];
    $eid=$_POST['txthidden'];
    
    if($eid!=0)
    {
        $upqry="update tbl_district set district_name='".$district."' where district_id='".$eid."'";
        if($con->query($upqry))
        {
            ?>
            <script>
            alert('updated');
            window.location="District.php";
            </script>
            <?php
        }
    }
    else
    {
        $insqry="insert into tbl_district(district_name)values('".$district."')";
        if($con->query($insqry))
        {
            ?>
            <script>
            alert('inserted');
            window.location='District.php';
            </script>
            <?php
        }
    }
}
if(isset($_GET['delID']))
{
    $del="delete from tbl_district where district_id='".$_GET['delID']."'";
    if($con->query($delqury))
    {
        ?>
        <script>
        alert('deleted');
        window.location='District.php';
        </script>
        <?php
    }
}
if(isset($_GET['editid']))
{
    $selqry="select * from tbl_district where district_id='".$_GET['editid']."'";
    $r=$con->query($selqry);
    if($d=$r->fetch_assoc())
    {
        $eid=$d['district_id'];
        $ename=$d['district_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District Management</title>
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
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 600px;
            margin-bottom: 30px;
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

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        td {
            color: #555;
        }

        td a {
            color: #ff7043; /* Light Orange */
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        td a:hover {
            text-decoration: underline;
        }

        input[type="text"] {
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
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Manage District</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>District Name</td>
                    <td>
                        <input name="txthidden" type="hidden" value="<?php echo $eid ?>"/>
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $ename ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="container">
        <h2>District List</h2>
        <table>
            <tr>
                <th>#</th>
                <th>District Name</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
            $sel="select * from tbl_district";
            $row=$con->query($sel);
            while($data=$row->fetch_assoc())
            {
                $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['district_name'] ?></td>
                <td class="action-buttons">
                    <a href="District.php?editid=<?php echo $data['district_id']?>">Edit</a>
                    <a href="District.php?delID=<?php echo $data['district_id']?>">Delete</a>
                </td>
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
