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
          <li class="<?= $current_page === 'listUserHDV' ? "active" : '' ?>"><a href="?action=listUserHDV">Danh sách khách</a></li>
          <li class="<?= $current_page === 'nhatKiTour' ? "active" : '' ?>"><a href="?action=nhatKiTour">Nhật kí tour</a></li>

        </ul>
      </aside>

      <!-- Main content -->
      <div class="main">
        <!-- Header -->
        <header class="header">
          <h2>LUXTUOR</h2>
          <div class="user-info">
            <span>Xin chào, HDV</span>
            <a href="login.html">Đăng Nhập</a>
          </div>
        </header>

        <!-- Charts and tables -->
        <section class="content">
          