<?php
include('Head.php');
include("../Assets/connection/connection.php");

if (isset($_POST["btn_submit"])) {
    $reply = $_POST['txt_reply'];
    $repid = $_GET["cid"]; // Fetch the complaint ID

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("UPDATE tbl_complaint SET complaint_status=?, content_reply=? WHERE complaint_id=?");
    $status = 1; // Set status to 1 (replied)

    $stmt->bind_param("isi", $status, $reply, $repid); // Bind parameters
    if ($stmt->execute()) {
        echo "<script>
                alert('Replied');
                window.location = 'Reply.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Complaint</title>
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
            max-width: 500px;
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

        table td:last-child textarea {
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
            transition: background-color 0.3s;
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
        <h2>Reply to Complaint</h2>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td>Reply:</td>
                    <td>
                        <textarea name="txt_reply" id="txt_reply" cols="45" rows="5" placeholder="Enter your reply" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-btn">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
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
