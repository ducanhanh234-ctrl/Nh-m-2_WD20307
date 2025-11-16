<?php
// Aggregator for Booking admin views - optional entry point
require_once "views/admin/layout/header.php";
?>

<div style="padding:16px">
  <h2>Booking Admin</h2>
  <ul>
    <li><a href="?action=manageBookings">Danh sách Booking</a></li>
    <li><a href="?action=addBooking">Thêm Booking</a></li>
    <li><a href="?action=quanlitrangthai">Quản lí trạng thái</a></li>
  </ul>
</div>

<?php require_once "views/admin/layout/footer.php"; ?>
