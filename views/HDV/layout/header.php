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

          <li class="<?= $current_page === 'index_hdv' ? "active" : '' ?>"><a href="?action=index_hdv">Index</a></li>
  
           
          <!-- Quản lý Phản Hồi Đánh Giá -->
          <li class="<?= $current_page === 'phanhoi-create' ? "active" : '' ?>"><a href="?action=phanhoi-create">Gửi phản hồi đánh giá</a></li>
            <!-- Quản lý Phản Hồi Đánh Giá -->
          <li class="<?= $current_page === 'kehoachkh-hdv' ? "active" : '' ?>"><a href="?action=kehoachkh-hdv">Xem Lịch Trình Làm Việc</a></li>
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
          