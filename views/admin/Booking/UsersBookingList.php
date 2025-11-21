<?php require_once "views/admin/layout/header.php"; ?>

<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="container" style="padding:16px">
    <h2>Danh sách HDV hiện có</h2>
<div class="add-booking-header">
    <a class="phanphong_style_btn" href="?action=manageBookings">← Quay lại</a>
  </div>
  
    <?php if (!empty($usersBooking) && is_array($usersBooking)): ?>
        <table class="styled-table" style="width:100%; margin-top:12px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Ngày sinh</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Loại HDV</th>
                    <th>Kinh nghiệm</th>
                    <th>Lịch sử dẫn tour</th>
                    <th>Đánh giá năng lực</th>
                    <th>Sức khỏe</th>
                    <th>Chức vụ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersBooking as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id'] ?? '') ?></td>
                        <td style="width:80px">
                            <?php if (!empty($u['avatar'])): ?>
                                <img src="<?= htmlspecialchars($u['avatar']) ?>" alt="avatar" style="width:64px;height:64px;object-fit:cover;border-radius:6px">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($u['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['ngaysinh'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['sdt'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['loaihdv_name'] ?? $u['loaihdv_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['kinhnghiem'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['lichsudantuor'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['danhgianangluc'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['suckhoe'] ?? '') ?></td>
                        <td><?= htmlspecialchars($u['chucvu'] ?? '') ?></td>
                        <td>
                            <?php // booking id passed in URL as id ?>
                            <?php $booking_id = $_GET['id'] ?? '';?>
                            <a class="phanphong_style_btn" href="?action=assignHdv&booking_id=<?= $booking_id ?>&hdv_id=<?= $u['id'] ?>">Chọn làm HDV</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có HDV nào.</p>
    <?php endif; ?>

</div>

<?php require_once "views/admin/layout/footer.php"; ?>