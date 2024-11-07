<?php
include("../Assets/Connection/Connection.php");

include("Head.php");


if(isset($_GET["acID"]))
{
	$upQry="update tbl_seller set seller_status='1' where seller_id='".$_GET["acID"]."'";
	if($con->query($upQry))
	{
		?>
		<script>
		alert('Accepted');
		window.location="SellerVerification.php";
        </script>
        <?php
	}
}


if(isset($_GET["rejID"]))
{
	$upQry="update tbl_seller set seller_status='2' where seller_id='".$_GET["rejID"]."'";
	if($con->query($upQry))
	{
		?>
		<script>
		alert('Rejected');
		window.location="SellerVerification.php";
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
<td><a href="HomePage.php">Home</a></td>

<h3>NewSeller</h3>
  <table width="244" border="1">
    <tr>
      <td width="58"><div align="center">#</div></td>
      <td width="80"><div align="center">District</div></td>
      <td width="80"><div align="center">Place</div></td>
      <td width="80"><div align="center">Pincode</div></td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>Proof</td>
      <td width="84"><div align="center">Action</div></td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='0'";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i?></td>
       <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <?php echo $data['place_pincode']?></td>
       <td> <?php echo $data['seller_name']?></td>
        <td> <?php echo $data['seller_email']?></td>
         
          <td> <?php echo $data['seller_contact']?></td>
           <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo']?>" width="75" height="75" /></td>
             <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof']?>" width="75" height="75" /></td>
            
            
      <td>
      <a href="SellerVerification.php?acID=<?php echo $data['seller_id']?>">Accept</a>
      <a href="SellerVerification.php?rejID=<?php echo $data['seller_id']?>">Reject</a></td>
    </tr>
     <?php
	}
	?>
   
  </table>
  
  <h3>AcceptedList</h3>
  <table width="244" border="1">
    <tr>
      <td width="58"><div align="center">#</div></td>
      <td width="80"><div align="center">District</div></td>
      <td width="80"><div align="center">Place</div></td>
      <td width="80"><div align="center">Pincode</div></td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>Proof</td>
      <td width="84"><div align="center">Action</div></td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='1'";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i?></td>
       <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <?php echo $data['place_pincode']?></td>
       <td> <?php echo $data['seller_name']?></td>
        <td> <?php echo $data['seller_email']?></td>
         
          <td> <?php echo $data['seller_contact']?></td>
           <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo']?>" width="75" height="75" /></td>
             <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof']?>" width="75" height="75" /></td>
            
            
      <td>
     
      <a href="SellerVerification.php?rejID=<?php echo $data['seller_id']?>">Reject</a></td>
    </tr>
     <?php
	}
	?>
   
  </table>
  
  
  <h3>RejectedList</h3>
  <table width="244" border="1">
    <tr>
      <td width="58"><div align="center">#</div></td>
      <td width="80"><div align="center">District</div></td>
      <td width="80"><div align="center">Place</div></td>
      <td width="80"><div align="center">Pincode</div></td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>Proof</td>
      <td width="84"><div align="center">Action</div></td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='2'";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i?></td>
       <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <?php echo $data['place_pincode']?></td>
       <td> <?php echo $data['seller_name']?></td>
        <td> <?php echo $data['seller_email']?></td>
         
          <td> <?php echo $data['seller_contact']?></td>
           <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo']?>" width="75" height="75" /></td>
             <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof']?>" width="75" height="75" /></td>
            
            
      <td>
      <a href="SellerVerification.php?acID=<?php echo $data['seller_id']?>">Accept</a>
     
    </tr>
     <?php
	}
	?>
   
  </table>

</body>
</html>
<?php
include("Foot.php");
?>z