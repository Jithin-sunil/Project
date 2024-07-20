<?php

include('../Assets/Connection/Connection.php');

if(isset($_POST['btnsubmit']))
{

	$subcategory=$_POST['subcategory'];
	
	$name=$_POST['txtname'];
	$price=$_POST['txtprice'];
	$details=$_POST['txtdetails'];
	
	$image=$_FILES['image']['name'];
	$temp=$_FILES['image']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/ProductDocs/'.$image);
	
	
	$insQry="insert into tbl_product(product_name,product_price,product_details,product_image,subcategory_id)
	values('$name','$price','$details','$image','$subcategory')";
	if($con->query($insQry))
	{
		echo"inserted";
	}
	else
	{
		?>
        <script>
		alert("Failure")
		</script>
        <?php
	}
	
}
?>
























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="392" border="1">
    <tr>
      <td width="76" height="50">Category</td>
      <td width="300">
   <select name="selCategory" onchange="getSubcat(this.value)">
   <option value="-----select-----">---select----</option>
   
   <?php
$selquery="select * from  tbl_Category";
$result=$con->query($selquery);

while($data = $result -> fetch_assoc())
{

	?>
<option value="<?php echo $data["category_id"]?>"><?php echo $data["category_name"] ?></option>

<?php
}
?>
</select>
</td>
    </tr>
    <tr>
      <td height="49">Subcategory</td>
      <td><label for="subcategory"></label>
        <select name="subcategory" id="subcategory">
        <option>--Select--</option>
      </select></td>
    </tr>
    <tr>
      <td height="49">Name</td>
      <td><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" /></td>
    </tr>
    <tr>
      <td height="43">Price</td>
      <td><label for="txtprice"></label>
      <input type="text" name="txtprice" id="txtprice" /></td>
    </tr>
    <tr>
      <td height="41">Details</td>
      <td><label for="txtdetails"></label>
      <input type="text" name="txtdetails" id="txtdetails" /></td>
    </tr>
    <tr>
      <td height="106">Image</td>
      <td><label for="image"></label>
      <input type="file" name="image" id="image" /></td>
    </tr>
    <tr>
      <td height="133" colspan="2" align="center"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      <input type="submit" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
  </table>
   <table width="246" height="79" border="1">
    <tr>
    <td>SLNO.</td>
      <td width="75">Category</td>
      <td width="75">SubCategory</td>
      <td>Name</td>
       <td>Price</td>
       <td>Image</td>
       <td>Details</td>
    </tr>
  
<?php
   $selquery="select * from tbl_product p inner join  tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on                s.category_id=c.category_id";
$result=$con->query($selquery);
$i=0;
while($data = $result -> fetch_assoc())
{
	$i++;
	?>
    <tr>
                <td><?php echo $i?></td>
	            <td><?php echo $data ["category_name"] ?></td>
            
                <td><?php echo $data ["subcategory_name"] ?></td>
                 <td><?php echo $data ["product_name"] ?></td>
                <td><?php echo $data ["product_price"] ?></td>
                <td><img src="../Assets/Files/ProductDocs/<?php echo $data ["product_image"] ?>" width="50" height="50" /></td>
                <td><?php echo $data["product_details"] ?></td>
                    </tr>  
   
    <?php
}
?>
  
  
</form>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubcat(did) {
    $.ajax({
      url: "../Assets/Ajax/AjaxSubcategory.php?did=" + did,
      success: function (result) {

        $("#subcategory").html(result);
      }
    });
  }

</script>