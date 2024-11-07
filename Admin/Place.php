<?php
include('Head.php');
include("../Assets/connection/connection.php");
if (isset($_POST["btn_submit"]))
{
    $district = $_POST["sel_dist"];
    $place = $_POST["txt_place"];
    $pincode = $_POST["txt_pincode"];
    $insqry = "insert into tbl_place(place_name, place_pincode, district_id) values('".$place."', '".$pincode."', '".$district."')";
    if($con->query($insqry))
    {
        echo "inserted";
        header("location:Place.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Place</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap');

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
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 12px 0;
            color: #555;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        input[type="submit"] {
            width: 100px;
            padding: 10px;
            background-color: #ffa726; /* Light Orange */
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ff7043; /* Darker Orange */
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Place</h2>
        <form name="form1" method="post" action="">
            <table>
                <tr>
                    <td>District</td>
                    <td>
                        <select name="sel_dist" id="sel_dist">
                            <option>--select--</option>
                            <?php
                            $sel = "select * from tbl_district";
                            $row = $con->query($sel);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $data['district_id'] ?>">
                                    <?php echo $data['district_name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Place</td>
                    <td>
                        <input type="text" name="txt_place" id="txt_place" />
                    </td>
                </tr>
                <tr>
                    <td>Pincode</td>
                    <td>
                        <input type="text" name="txt_pincode" id="txt_pincode" />
                    </td>
                </tr>
            </table>
            <div class="center-btn btn-container">
                <input type="submit" name="btn_submit" value="Save" />
                <input type="submit" name="btn_cancel" value="Cancel" />
            </div>
        </form>
    </div>
</body>
</html>

<?php
include('Foot.php');
?>
