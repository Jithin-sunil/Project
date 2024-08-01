 <?php
 include('../Assets/Connection/Connection.php');
include('Header.php');

if(isset($_POST['txtsubmit']))
{
	$name=$_POST['txtname'];
	$model=$_POST['txtmobile'];

	$price=$_POST['price'];
	$insQry="insert into tbl_mobile(mobile_name,mobile_model,mobile_price,company_id)values('$name','$model','$price','".$_SESSION['company_id']."')";
	if($con->query($insQry))
	{
		echo"inserted";
	}
}
if(isset($_GET["delID"]))
{
	$mobileId=$_GET["delID"];
	$delQry="delete from tbl_mobile where mobile_id=$mobileId";
    if($con -> query($delQry))
	{
		// echo"deleted";
		// header("location:Mobile.php");
	}
}
?>


  
  <form id="form1" name="form1" method="post" action="">
  <table width="269" border="1">
    <tr>
      <td width="123" scope="col">Name</td>
      <td width="130" scope="col"><label for="txtname"></label>
      <input type="text" name="txtname" id="txtname" /></td>
    </tr>
    <tr>
      <td>Model</td>
      <td><label for="txtmobile"></label>
      <input type="text" name="txtmobile" id="txtmobile" /></td>
    </tr>
   
    <tr>
      <td>Price</td>
      <td><label for="price"></label>
      <input type="text" name="price" id="price" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;&nbsp;<input type="submit" name="txtsubmit" id="txtsubmit" value="Submit" />        <input type="reset" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
 <br />
  <table border="1" align="center">
<tr>

<td>SLNO</td>
<td>Name</td>
<td>Model</td>
<td>Price</td>
<td>Company</td>
<td colspan="2" align="center">Action</td>

</tr>
<?php
$selquery="select * from tbl_mobile m inner join tbl_company c on m.company_id=c.company_id";
$result=$con->query($selquery);
$i=0;
while($data = $result -> fetch_assoc())
{
	$i++;
	?>
    <tr>
    <td><?php echo $i?></td>
	<td><?php echo $data["mobile_name"] ?></td>
    <td><?php echo $data["mobile_model"] ?></td>
    <td><?php echo $data["mobile_price"] ?></td>
    <td><?php echo $data["company_name"] ?></td>
    <td><a href="Mobile.php?delID=<?php echo $data["mobile_id"]?>">DELETE</a></td>
    <td><a href="MobileDetails.php?mID=<?php echo $data["mobile_id"]?>">ViewMore</a></td>
    </tr> 
   
    <?php
}
?>
</table>
</form>
</body>
</html>
<?php
include('Footer.php');
?>


