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
    <link rel="stylesheet" href="./views/admin/css.css" />


  </head>
  <body>
    <div class="dashboard">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="logo">LUXTUOR</div>
        <ul class="menu">

          <li class="<?= $current_page === 'index' ? "active" : '' ?>"><a href="?action=index">Index</a></li>
            <!-- Xử lí để lấy active -->
          <li class="<?= $current_page === 'manageBookings' ? "active" : '' ?>"><a href="?action=manageBookings">Quản lí booking</a></li>
          <li class="<?= $current_page === 'quanlitrangthai' ? "active" : '' ?>"><a href="?action=quanlitrangthai">Quản lí trạng thái Booking</a></li>
        </ul>
      </aside>

      <!-- Main content -->
      <div class="main">
        <!-- Header -->
        <header class="header" style=" height:69px">
          <h2>LUXTUOR</h2>
          <div class="user-info">
            <span>Xin chào, Admin</span>
            <a href="login.html">Đăng Nhập</a>
          </div>
        </header>

        <!-- Charts and tables -->
        <section class="content">
          