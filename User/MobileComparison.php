<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Comparison</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

       
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

       
        form {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        
        .result-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .result {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 45%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .result h3 {
            margin-top: 0;
            color: #333;
        }

        .result p {
            margin: 5px 0;
            color: #666;
        }

      
        @media (max-width: 768px) {
            .form-container, .result-container {
                flex-direction: column;
                align-items: center;
            }

            form, .result {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
       

        <div class="form-container">
            <form action="" method="post">
                <table>
                    <tr>
                        <th>Brand</th>
                        <th>Phone</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="sel_brand1" id="sel_brand1" onchange="getPhone(this.value, 1)">
                                <option value="">--Select--</option>
                                <?php
                                include('../Assets/Connection/Connection.php'); 
                                $selqry = "select * from tbl_company";
                                $res = $con->query($selqry);
                                while ($resdata = $res->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $resdata['company_id']?>"><?php echo $resdata["company_name"]?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="sel_phone1" id="sel_phone1" onchange="Search(this.value, 1)">
                                <option value="">--Select--</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>

            <form action="" method="post">
                <table>
                    <tr>
                        <th>Brand</th>
                        <th>Phone</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="sel_brand2" id="sel_brand2" onchange="getPhone(this.value, 2)">
                                <option value="">--Select--</option>
                                <?php
                                $selqry = "select * from tbl_company";
                                $res = $con->query($selqry);
                                while ($resdata = $res->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $resdata['company_id']?>"><?php echo $resdata["company_name"]?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="sel_phone2" id="sel_phone2" onchange="Search(this.value, 2)">
                                <option value="">--Select--</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="result-container">
            <div class="result" id="result1">
                <?php
                $se = "select * from tbl_mobile";
                $data = $con->query($se);
                while ($row0 = $data->fetch_assoc()) {
                ?>
                <h3><?php echo $row0["mobile_name"]?></h3>
                <p>Price: <?php echo $row0["mobile_price"]?></p>
                <p>Model: <?php echo $row0["mobile_model"]?></p>
                <p><a href="#" onclick="addCart(<?php echo $row0['mobile_id']?>)"> Buy</a></p>
                <?php
                }
                ?>
            </div>

            <div class="result" id="result2">
                <?php
                $se = "select * from tbl_mobile";
                $data = $con->query($se);
                while ($row0 = $data->fetch_assoc()) {
                ?>
                <h3><?php echo $row0["mobile_name"]?></h3>
                <p>Price: <?php echo $row0["mobile_price"]?></p>
                <p>Model: <?php echo $row0["mobile_model"]?></p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
    function getPhone(did, formNumber) {
        $.ajax({
            url: "../Assets/Ajax/AjaxPhone.php?did=" + did,
            success: function(result) {
                $("#sel_phone" + formNumber).html(result);
            }
        });
    }

    function Search(mid, formNumber) {
        $.ajax({
            url: "../Assets/Ajax/AjaxSearch.php?mid=" + mid,
            success: function(result) {
                $("#result" + formNumber).html(result);
            }
        });
    }
    function addCart(id)
            {
                $.ajax({
                    url: "../Assets/Ajax/AjaxAddCart.php?id=" + id,
					
                    success: function(response) {
                        console.log(response);
						
                        if (response.trim() === "Added to Cart")
                        {
                            $("success").fadeIn(300).delay(1500).fadeOut(400);
                        }
                        else if (response.trim() === "Already Added to Cart")
                        {
                            $("warning").fadeIn(300).delay(1500).fadeOut(400);
                        }
                        else
                        {
                            $("failure").fadeIn(300).delay(1500).fadeOut(400);
                        }
                    }
                });
            }
    </script>

</body>
</html>