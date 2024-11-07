<?php
session_start();
if($_SESSION['userid']==""){
    header('location:../Guest/Login.php');
}
?>