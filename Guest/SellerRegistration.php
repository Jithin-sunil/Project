<?php
include("../Assets/connection/connection.php");
if(isset($_POST["btn_submit"]))
{
    $Name = $_POST["txt_name"];
    $Email = $_POST["txt_email"];
    $Place = $_POST["sel_place"];
    $Contact = $_POST["txt_contact"];
    $Password = $_POST["txt_password"];

    $photo = $_FILES["photo"]["name"];
    $temp = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($temp, "../Assets/File/seller/Photo/" . $photo);

    $proof = $_FILES["proof"]["name"];
    $temp = $_FILES["proof"]["tmp_name"];
    move_uploaded_file($temp, "../Assets/File/seller/Photo/" . $proof);

    $place = $_POST['sel_place'];
    $insqry = "insert into tbl_seller(seller_name,seller_email,place_id,seller_contact,seller_password,seller_photo,seller_proof)values('".$Name."','".$Email."','".$Place."','".$Contact."','".$Password."','".$photo."','".$proof."')";
    if($con->query($insqry))
    {
        ?>
        <script>
        alert('inserted');
        window.location = 'SellerRegistration.php';
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
    <title>Seller Registration</title>
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
        table td:last-child select {
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

        input[type="file"] {
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Seller Registration</h2>
        <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="txt_name" id="txt_name" placeholder="Enter your name" />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="txt_email" id="txt_email" placeholder="Enter your email" />
                    </td>
                </tr>
                <tr>
                    <td>District:</td>
                    <td>
                        <select name="sel_district" id="sel_district" onchange="getPlace(this.value)">
                            <option value="">--Select--</option>
                            <?php
                            $sel = "select * from tbl_district";
                            $row = $con->query($sel);
                            while($data = $row->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Place:</td>
                    <td>
                        <select name="sel_place" id="sel_place">
                            <option value="">--Select--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td>
                        <input type="text" name="txt_contact" id="txt_contact" placeholder="Enter your contact number" />
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="txt_password" id="txt_password" placeholder="Enter your password" />
                    </td>
                </tr>
                <tr>
                    <td>Photo:</td>
                    <td>
                        <input type="file" name="photo" id="photo" />
                    </td>
                </tr>
                <tr>
                    <td>Proof:</td>
                    <td>
                        <input type="file" name="proof" id="proof" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        <br><br>
                        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function(result) {
                    $("#sel_place").html(result);
                }
            });
        }
    </script>
</body>

</html>
