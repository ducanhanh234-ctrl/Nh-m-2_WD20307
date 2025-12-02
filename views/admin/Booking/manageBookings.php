<?php
require_once "views/admin/layout/header.php";
?>
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="chart">
    <div class="button-group">
        <a class="phanphong_style_btn" href="?action=addBooking">Thêm Booking</a>
        <a class="sua_style_btn" href="?action=quanlitrangthai">Quản lí trạng thái</a>
    </div>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; padding: 15px; margin: 15px 0; border-radius: 5px; border: 1px solid #f5c6cb;">
            <?= ($_SESSION['error_message']) ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; margin: 15px 0; border-radius: 5px; border: 1px solid #c3e6cb;">
            <?= ($_SESSION['success_message']) ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($bookings) && is_array($bookings)): ?>
        <div class="table_qlpbt">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách</th>
                    <th>Số Người</th>


                    <th>HDV</th>
                    <th>Trạng Thái</th>
                    <th>Chi tiết</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?? '' ?></td>
                        <td><?= $item['tenkhach'] ?? '' ?></td>
                        <td><?= $item['soluong_nguoi'] ?? $item['soluongnguoi'] ?? $item['soluong_nguoi'] ?? '' ?></td>


                        <td>
                            <?php if (!empty($item['hdv_name']) || !empty($item['hdv_id'])): ?>
                                <?= htmlspecialchars($item['hdv_name'] ?? $item['hdv_id']) ?>
                            <?php else: ?>
                                <a class="phanphong_style_btn" href="?action=UsersBookingList&id=<?= $item['id'] ?>">Thêm HDV</a>
                            <?php endif; ?>
                        </td>
                        <td><?= $item['status_name'] ?? '' ?></td>
                        <td>
                            <a class="phanphong_style_btn" href="?action=xemChiTietBooking&id=<?= $item['id'] ?>">Xem chi tiết</a>
                        </td>
                        <td class="action">
                            <a class="sua_style_btn cta" href="?action=editBooking&id=<?= $item['id'] ?>">Sửa</a>
                            <a class="xoa_style_btn cta" href="?action=deleteBooking&id=<?= $item['id']?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                       </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <div class="chart">
            <p>Không có booking nào.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once "views/admin/layout/footer.php"; ?>
