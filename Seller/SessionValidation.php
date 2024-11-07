<?php
session_start();
if($_SESSION['sellerid']==""){
    header('location:../Guest/Login.php');
}
?>