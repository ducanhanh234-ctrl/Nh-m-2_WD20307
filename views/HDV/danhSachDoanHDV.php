<?php require_once "views/HDV/layout/header.php"; ?>

<link rel="stylesheet" href="./assets/style/HDVCSS/HDV.css">

<div class="container" style="padding:16px">
    <h2>Danh sách khách đi tour</h2>
    <div class="add-booking-header">
        <a class="phanphong_style_btn" href="?action=listUserHDV">← Quay lại</a>
    </div>
    
    <?php if (!empty($booking) && is_array($booking)): ?>
        <table class="styled-table" style="width:100%; margin-top:12px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>SĐT</th>
                    <th>Giới tính</th>
                    <th>CCCD</th>
                    <th>Ngày sinh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($booking as $khach): ?>
                    <tr>
                        <td><?= $khach['id'] ?? '' ?></td>
                        <td><?= $khach['hovaten'] ?? '' ?></td>
                        <td><?= $khach['sdt'] ?? '' ?></td>
                        <td><?= $khach['gioitinh'] ?? '' ?></td>
                        <td><?= $khach['cccd'] ?? '' ?></td>
                        <td><?= $khach['ngaysinh'] ?? '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="chart" style="margin-top:20px">
            <p>Chưa có danh sách khách nào cho booking này.</p>
        </div>
    <?php endif; ?>

</div>

<?php require_once "views/admin/layout/footer.php"; ?>