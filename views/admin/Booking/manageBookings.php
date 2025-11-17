<?php
require_once "views/admin/layout/header.php";
?>
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="chart">
    <div class="button-group">
        <a class="phanphong_style_btn" href="?action=addBooking">Thêm Booking</a>
        <a class="sua_style_btn" href="?action=quanlitrangthai">Quản lí trạng thái</a>
    </div>

    <?php if (!empty($bookings) && is_array($bookings)): ?>
        <div class="table_qlpbt">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Tour</th>
                    <th>Số Người</th>
                    <th>Giới Tính</th>
                    <th>Số ngày</th>
                    <th>Yêu Cầu</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?? '' ?></td>
                        <td><?= $item['tenkhach'] ?? '' ?></td>
                        <td><?= $item['sdt'] ?? '' ?></td>
                        <td><?= $item['email'] ?? '' ?></td>
                        <td><?= $item['tour_name'] ?? '' ?></td>
                        <td><?= $item['soluong_nguoi'] ?? $item['soluongnguoi'] ?? $item['soluong_nguoi'] ?? '' ?></td>
                        <td><?= $item['gioitinh'] ?? '' ?></td>
                        <td><?= $item['songay'] ?? '' ?></td>
                        <td><?= $item['yeucaudacbiet'] ?? '' ?></td>
                        <td><?= $item['status_name'] ?? '' ?></td>
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
