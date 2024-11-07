<?php
include("SessionValidation.php");
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="../Assets/Template/Mainimages/favicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Pearl Palace</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../Assets/Template/Main/css/bootstrap.css" />
  <!-- font awesome style -->
  <link href="../Assets/Template/Main/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../Assets/Template/Main/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../Assets/Template/Main/css/responsive.css" rel="stylesheet" />

</head>
<style>
  .navbar-brand span {
    font-size: 24px;
    font-weight: 700;
    color: #000;
    text-transform: uppercase;
}
</style>

<body>

  <!-- header section strats -->
  <header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="index.html">
          <span>
          Pearl Palace
          </span>
        </a>
        <div class="" id="">

        <div class="custom_menu-btn">
            <button onclick="openNav()">
              <span class="s-1"> </span>
              <span class="s-2"> </span>
              <span class="s-3"> </span>
            </button>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="HomePage.php">Home</a>
                <a href="SearchProduct.php">SearchProduct</a>
                <a href="Myprofile.php">Myprofile</a>
                <a href="Mybooking.php">Mybooking</a>
                <a href="MYCart.php">MYCart</a>
                <a href="MyComplaints.php">MyCompaints</a>
                <a href="../Logout.php">Logout</a>
              </div>
            </div>
          </div>

        </div>
      </nav>
    </div>
  </header>
  <!-- end header section -->
  <section class="shop_section layout_padding">
  <div class="container">