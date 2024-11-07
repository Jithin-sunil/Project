<?php
$server="localhost";
$user="root";
$password="";
$db="db_onlinejewlery";
$con=mysqli_connect($server,$user,$password,$db);
if(!$con)
{
	echo"connection failed";
}
?>