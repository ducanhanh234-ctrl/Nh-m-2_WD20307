<?php require_once "views/admin/layout/header.php"; ?>

<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="container" style="padding:16px">
    <div class="add-booking-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px">
        <div>
            <h2>Chi tiết Booking Của Khách: <?= ($booking['tenkhach'] ?? '') ?></h2>
            <p style="color:#666;">Xem đầy đủ thông tin booking, tour, khách sạn và khách tham gia.</p>
        </div>
        <a class="phanphong_style_btn" href="?action=manageBookings">← Quay lại danh sách</a>
    </div>

    <?php if (!empty($booking)): ?>
        <div class="row" style="display:flex; gap:16px; flex-wrap:wrap">
            <!-- Thông tin cơ bản -->
            <div class="card" style="flex:1 1 320px; background:#fff; border-radius:8px; padding:16px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom:12px;">Thông tin cơ bản</h3>
                <div class="info-grid">
                    <p><strong>Tên khách:</strong> <?= $booking['tenkhach'] ?? '' ?></p>
                    <p><strong>Số điện thoại:</strong> <?= $booking['sdt'] ?? '' ?></p>
                    <p><strong>Email:</strong> <?= $booking['email'] ?? '' ?></p>
                    <p><strong>Giới tính:</strong> <?= $booking['gioitinh'] ?? '' ?></p>
                    <p><strong>CCCD:</strong> <?= $booking['cccd'] ?? '' ?></p>
                    <p><strong>Số người:</strong> <?= $booking['soluong_nguoi'] ?? '' ?></p>
                </div>
            </div>

            <!-- Thông tin tour & dịch vụ -->
            <div class="card" style="flex:1 1 320px; background:#fff; border-radius:8px; padding:16px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom:12px;">Thông tin tour & dịch vụ</h3>
                <div class="info-grid">
                    <p><strong>Tour:</strong> <?= ($booking['tour_name'] ?? '') ?></p>
                    <p><strong>Ngày khởi hành:</strong> <?= ($booking['ngaykhoi_hanh'] ?? '') ?></p>
                    <p><strong>Số ngày:</strong> <?= ($booking['songay'] ?? '') ?></p>
                    <p><strong>Phương tiện:</strong> <?= ($booking['phuongtien_name'] ?? '') ?></p>
                    <p><strong>Nhà cung cấp (phương tiện):</strong> <?= ($booking['nhacungcap_phuongtien_name'] ?? '') ?></p>
                    <p><strong>Khách sạn:</strong> <?= ($booking['khachsan_name'] ?? '') ?></p>
                    <p><strong>Nhà cung cấp (khách sạn):</strong> <?= ($booking['nhacungcap_khachsan_name'] ?? '') ?></p>
                    <p><strong>HDV phụ trách:</strong> <?= ($booking['hdv_name'] ?? '') ?></p>
                </div>
            </div>

            <!-- Yêu cầu đặc biệt -->
            <div class="card" style="flex:1 1 100%; background:#fff; border-radius:8px; padding:16px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom:12px;">Yêu cầu đặc biệt</h3>
                <p><?= nl2br(htmlspecialchars($booking['yeucaudacbiet'] ?? 'Không có yêu cầu đặc biệt.')) ?></p>
            </div>
        </div>

        <!-- Danh sách khách đi tour -->
        <div class="card" style="margin-top:20px; background:#fff; border-radius:8px; padding:16px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <h3>Danh sách khách tham gia</h3>
                <a class="phanphong_style_btn" href="?action=themDanhSachKhach&id=<?= $booking['id'] ?>">Thêm danh sách khách</a>
            </div>

            <?php if (!empty($dsKhach) && is_array($dsKhach)): ?>
                <table class="styled-table" style="width:100%; margin-top:8px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>CCCD</th>
                            <th>SĐT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dsKhach as $index => $khach): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $khach['hovaten'] ?? '' ?></td>
                                <td><?= $khach['ngaysinh'] ?? '' ?></td>
                                <td><?= $khach['gioitinh'] ?? '' ?></td>
                                <td><?= $khach['cccd'] ?? '' ?></td>
                                <td><?= $khach['sdt'] ?? '' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="margin-top:8px;">Chưa có danh sách khách nào cho booking này.</p>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <div class="chart" style="margin-top:20px">
            <p>Không tìm thấy booking.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once "views/admin/layout/footer.php"; ?>


