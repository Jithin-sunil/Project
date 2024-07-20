<?php
include('../Assets/Connection/Connection.php');
include('Header.php');


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<table width="666" height="161" border="1">
<tr>
		<td>Service Center Name</td>
		<td>Service Center Contact</td>
		<td>Service Center Address</td>
        <td width="33">Service Name</td>
        <td width="55">Service Details</td>
		<td width="55">Service Price</td>
        <td width="44">Status</td>
        
        </tr>
        <tr>
		 <?php
		$selqurey="select * from tbl_request r inner join tbl_servicetype s on r.servicetype_id = s.servicetype_id inner join tbl_servicecenter t on s.servicecenter_id = t.servicecenter_id where r.user_id='".$_SESSION['uid']."'" ;
		 $result=$con->query($selqurey);
        $i=0;
        while($data=$result->fetch_assoc())
		{
            $i++;
            ?>
            <tr>
			<td><?php echo $data['servicecenter_name'] ?></td>
			<td><?php echo $data['servicecenter_contact'] ?></td>
			<td><?php echo $data['servicecenter_address'] ?></td>
            <td><?php echo $data["servicetype_type"]?></td>
            <td><?php echo $data["servicetype_details"]?></td>
            <td><?php echo $data["servicetype_rate"]?></td>
           
             <td><?php
			 if($data['request_status']=='0')
			 {
				 echo 'Pending';
			 }
			  else if($data['request_status']=='1')
			 {
				 echo 'Accepted';
				 
			 }
			  
			  else
			 {
				 echo 'Rejected';
			 }
			 ?>
			</td>
            </tr>
            <?php
            } 
            ?> 
            
            
            </table>
		
</body>
</html>
<?php
include('Footer.php');
?>