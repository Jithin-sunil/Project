<?php
include('../Assets/Connection/Connection.php');
if(isset($_POST["btn_signup"]))
{
    $Name=$_POST['txt_name'];
    $Address=$_POST['txt_address'];
    $Contact=$_POST['txt_contact'];
    $Email=$_POST['txt_Email'];
    $Gender=$_POST['txt_gender'];
    $DOB=$_POST['txt_dob'];
    $Password=$_POST['txt_password'];
    $Confirm=$_POST['txt_confirm'];

    $photo=$_FILES["file_photo"]["name"];
    $temp=$_FILES["file_photo"]["tmp_name"];
    move_uploaded_file($temp,"../Assets/File/User/Photo/".$photo);

    $place=$_POST['sel_place'];

    $insqry="insert into 
    tbl_user(user_name,user_address,user_contact,user_email,user_photo,user_gender,user_dob,user_password,place_id)values('".$Name."','".$Address."','".$Contact."','".$Email."','".$photo."','".$Gender."','".$DOB."','".$Password."','".$place."')";
    if($con->query($insqry))
    {
        ?>
        <script>
        alert('Inserted');
        window.location='Newuser.php';
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
    <title>User Sign Up</title>
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
        table td:last-child textarea,
        table td:last-child select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: none;
        }

        input[type="radio"] {
            width: auto;
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

        .gender-option {
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .gender-option label {
            margin-right: 15px;
            display: flex;
            align-items: center;
        }

        .gender-option input {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>User Sign Up</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" required name="txt_name" id="txt_name" placeholder="Enter your name" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required />
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <textarea name="txt_address" id="txt_address" cols="45" rows="5" placeholder="Enter your address" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td>
                        <input type="text" name="txt_contact" id="txt_contact" placeholder="Enter your contact number" pattern="[7-9]{1}[0-9]{9}" 
                title="Phone number with 7-9 and remaing 9 digit with 0-9 "required />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="txt_Email" id="txt_Email" placeholder="Enter your email"required />
                    </td>
                </tr>
                <tr>
                    <td>District:</td>
                    <td>
                        <select name="sel_District" id="sel_District" onchange="getPlace(this.value)"required>
                            <option value="">--Select--</option>
                            <?php
                            $sel="select * from tbl_district";
                            $row=$con->query($sel);
                            while($data=$row->fetch_assoc())
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
                        <select name="sel_place" id="sel_place"required>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Photo:</td>
                    <td>
                        <input type="file" name="file_photo" id="file_photo" required/>
                    </td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td class="gender-option">
                        <label><input type="radio" name="txt_gender" id="txt_gender" value="male"required />Male</label>
                        <label><input type="radio" name="txt_gender" id="txt_gender" value="female" />Female</label>
                    </td>
                </tr>
                <tr>
                    <td>DOB:</td>
                    <td>
                        <input type="date" name="txt_dob" id="txt_dob"required />
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="txt_password" id="txt_password" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="txt_confirm" id="txt_confirm" placeholder="Confirm your password"required />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_signup" id="btn_signup" value="Sign Up" />
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
                success: function (result) {
                    $("#sel_place").html(result);
                }
            });
        }
    </script>
</body>

</html>
