<?php
require_once "views/HDV/layout/header.php";
?>
<link rel="stylesheet" href="./assets/style/HDVCSS/HDV.css">

<div class="chart">
    <?php if (!empty($bookingById) && is_array($bookingById)): ?>
        <div class="table_qlpbt">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Booking</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Tour</th>
                    <th>Số Người</th>
                    <th>Giới Tính</th>
                    <th>Số ngày</th>
                    <th>Phương tiện</th>
                    <th>Danh sách khách đi tour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookingById as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?? '' ?></td>
                        <td><?= $item['tenkhach'] ?? '' ?></td>
                        <td><?= $item['sdt'] ?? '' ?></td>
                        <td><?= $item['email'] ?? '' ?></td>
                        <td><?= $item['tour_name'] ?? '' ?></td>
                        <td><?= $item['soluong_nguoi'] ?? $item['soluongnguoi'] ?? $item['soluong_nguoi'] ?? '' ?></td>
                        <td><?= $item['gioitinh'] ?? '' ?></td>
                        <td><?= $item['songay'] ?? '' ?></td>
                        <td><?= $item['phienban_phuongtien'] ?? '' ?></td>
                        <td>
                            <a class="phanphong_style_btn" href="?action=danhSachDoanHDV&id=<?= $item['id'] ?>">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <div class="chart">
            <p>Không có user nào.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once "views/admin/layout/footer.php"; ?>
