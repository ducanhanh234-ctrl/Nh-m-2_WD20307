<?php
// ! Xử lí để lấy active
$current_page = $_GET['action'] ?? 'index';
?>


<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Material Dashboard</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/css.css" />


  </head>
  <body>
    <div class="dashboard">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="logo">LUXTUOR</div>
        <ul class="menu">

          <li class="<?= $current_page === 'index' ? "active" : '' ?>"><a href="?action=index">Index</a></li>
            <!-- Xử lí để lấy active -->
          
          <!-- Quản lý Booking -->
          <li class="<?= $current_page === 'manageBookings' ? "active" : '' ?>"><a href="?action=manageBookings">Quản lí Booking</a></li>
          
          <!-- Quản lý Tour -->
          <li class="<?= $current_page === 'tuor-list' ? "active" : '' ?>"><a href="?action=tuor-list">Quản lí Tour</a></li>
          <li class="<?= $current_page === 'tuor_danhmuc' ? "active" : '' ?>"><a href="?action=tuor_danhmuc">Quản lí Danh Mục Tour</a></li>
          
          <!-- Quản lý Phiên Bản -->
          <li class="<?= $current_page === 'phienban-list' ? "active" : '' ?>"><a href="?action=phienban-list">Quản lí Phiên Bản</a></li>
          
          <!-- Quản lý Nhà Cung Cấp -->
          <li class="<?= $current_page === 'nhacungcap-list' ? "active" : '' ?>"><a href="?action=nhacungcap-list">Quản lí Nhà Cung Cấp</a></li>
          
          <!-- Quản lý Nhân Sự -->
          <li class="<?= $current_page === 'listUsers' ? "active" : '' ?>"><a href="?action=listUsers">Quản lí Nhân Sự</a></li>
          
          <!-- Quản lý Giá -->
          <li class="<?= $current_page === 'gia-list' ? "active" : '' ?>"><a href="?action=gia-list">Quản lí Giá</a></li>
           
          <!-- Quản lý Phản Hồi Đánh Giá -->
          <li class="<?= $current_page === 'phanhoi-list' ? "active" : '' ?>"><a href="?action=phanhoi-list">Danh sách phản hồi đánh giá</a></li>
           <!-- Quản lý Kế Hoạch Khởi Hành -->
          <li class="<?= $current_page === 'kehoanhkh-list' ? "active" : '' ?>"><a href="?action=kehoachkh-list">Danh sách Kế Hoạch Khởi Hành</a></li>
           <!-- Quản lý Đăng Nhập -->
          <li class="<?= $current_page === 'login-list' ? "active" : '' ?>"><a href="?action=login-list">Danh sách Quản Lý Đăng Nhập</a></li>
          <!-- Quản lý Doanh Thu -->
          <li class="<?= $current_page === 'doanhthu-list' ? "active" : '' ?>"><a href="?action=doanhthu-list">Danh sách Quản Lý Doanh Thu</a></li>
          <!-- Quản lý Lịch Trình -->
          <li class="<?= $current_page === 'lichtrinh-list' ? "active" : '' ?>"><a href="?action=lichtrinh-list">Danh sách Quản Lý Lịch Trình</a></li>
        </ul>
      </aside>

      <!-- Main content -->
      <div class="main">
        <!-- Header -->
        <header class="header">
          <h2>LUXTUOR</h2>
          <div class="user-info">
            <?php
            if(isset($_SESSION["name"])){
              ?>
              <span>Xin chào, <?=$_SESSION["name"]?></span>
            <a href="?action=logout">Đăng Xuất</a>
              <?php
            }else{
              ?>
              <a href="?action=login">Đăng Nhập</a>
              <?php
            }
            ?>
          </div>
        </header>

        <!-- Charts and tables -->
        <section class="content">
          