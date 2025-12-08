<?php require_once "views/admin/layout/header.php"; ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking-detail.css">

<div class="container-fluid p-4">
    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($_SESSION['success_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($_SESSION['error_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <!-- Header -->
    <div class="bg-white rounded shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Chi tiết Booking Của Khách: <?= htmlspecialchars($booking['tenkhach'] ?? '') ?></h2>
                <p class="text-muted mb-0">Xem đầy đủ thông tin booking, tour, khách sạn và khách tham gia.</p>
            </div>
            <a href="?action=manageBookings" class="btn btn-outline-secondary">← Quay lại danh sách</a>
        </div>
    </div>

    <?php if (!empty($booking)): ?>
        <div class="row g-4">
            <!-- Cột Trái (70%) -->
            <div class="col-lg-8">
                <!-- Thông tin người đặt -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Thông tin người đặt</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Tên khách:</strong> <?= htmlspecialchars($booking['tenkhach'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Số điện thoại:</strong> <?= htmlspecialchars($booking['sdt'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($booking['email'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Giới tính:</strong> <?= htmlspecialchars($booking['gioitinh'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>CCCD:</strong> <?= htmlspecialchars($booking['cccd'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Số người:</strong> <?= htmlspecialchars($booking['soluong_nguoi'] ?? '') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách thành viên đoàn (chỉ xem) -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Danh sách thành viên đoàn</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($dsKhach) && is_array($dsKhach)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">#</th>
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
                                                <td><?= htmlspecialchars($khach['hovaten'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($khach['ngaysinh'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($khach['gioitinh'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($khach['cccd'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($khach['sdt'] ?? '') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">Chưa có danh sách khách nào cho booking này.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Thông tin Tour & Dịch vụ -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-map me-2"></i>Thông tin Tour & Dịch vụ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Tour:</strong> <?= htmlspecialchars($booking['tour_name'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Ngày khởi hành:</strong> <?= htmlspecialchars($booking['ngaykhoi_hanh'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Số ngày:</strong> <?= htmlspecialchars($booking['songay'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Phương tiện:</strong> <?= htmlspecialchars($booking['phuongtien_name'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Nhà cung cấp (phương tiện):</strong> <?= htmlspecialchars($booking['nhacungcap_phuongtien_name'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Khách sạn:</strong> <?= htmlspecialchars($booking['khachsan_name'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Nhà cung cấp (khách sạn):</strong> <?= htmlspecialchars($booking['nhacungcap_khachsan_name'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>HDV phụ trách:</strong> <?= htmlspecialchars($booking['hdv_name'] ?? 'Chưa có') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yêu cầu đặc biệt -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Yêu cầu đặc biệt</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($booking['yeucaudacbiet'] ?? 'Không có yêu cầu đặc biệt.')) ?></p>
                    </div>
                </div>
            </div>

            <!-- Cột Phải (30% - Sticky) -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <!-- Box 1: Tài chính -->
                    <div class="card mb-4 border-danger">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-cash-coin me-2"></i>Tài chính</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $tongTien = $booking['tong_tien_tour'] ?? 0;
                            $daTra = $booking['da_thanh_toan'] ?? 0;
                            $conNo = $tongTien - $daTra;
                            ?>
                            <div class="mb-3">
                                <label class="text-muted small">Tổng tiền</label>
                                <h4 class="mb-0 text-primary"><?= number_format($tongTien, 0, ',', '.') ?> đ</h4>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Đã trả</label>
                                <h4 class="mb-0 text-success"><?= number_format($daTra, 0, ',', '.') ?> đ</h4>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small">Còn nợ</label>
                                <h4 class="mb-0 <?= $conNo > 0 ? 'text-danger fw-bold' : 'text-success' ?>">
                                    <?= number_format($conNo, 0, ',', '.') ?> đ
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Box 2: Hành động -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Hành động</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                <i class="bi bi-plus-circle me-2"></i>Thêm thanh toán
                            </button>
                        </div>
                    </div>

                    <!-- Box 3: Trạng thái -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-flag me-2"></i>Trạng thái</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Trạng thái hiện tại</label>
                                <div class="alert alert-info mb-0">
                                    <strong><?= htmlspecialchars($booking['status_name'] ?? 'Chưa xác định') ?></strong>
                                </div>
                            </div>
                            <form method="POST" action="?action=updateStatusBooking">
                                <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Thay đổi trạng thái</label>
                                    <select name="status" class="form-select" required>
                                        <?php foreach ($listStatus as $status): ?>
                                            <option value="<?= $status['id'] ?>" <?= ($status['id'] == $booking['trangthai_booking']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($status['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="bi bi-check-circle me-2"></i>Cập nhật
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Box 4: Lịch sử thanh toán -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Lịch sử thanh toán</h5>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            <?php if (!empty($paymentHistory) && is_array($paymentHistory)): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($paymentHistory as $payment): ?>
                                        <?php
                                            $soTien = (int)($payment['so_tien'] ?? 0);
                                            if ($soTien <= 0) {
                                                continue;
                                            }

                                            $ngayThanhToanRaw = $payment['ngay_thanh_toan'] ?? null;
                                            $ngayThanhToanText = '';
                                            if (!empty($ngayThanhToanRaw)) {
                                                $timestamp = strtotime($ngayThanhToanRaw);
                                                if ($timestamp !== false) {
                                                    $ngayThanhToanText = date('d/m/Y H:i', $timestamp);
                                                }
                                            }
                                        ?>
                                        <div class="list-group-item px-0 py-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <strong class="text-success"><?= number_format($soTien, 0, ',', '.') ?> đ</strong>
                                                    <?php if (!empty($ngayThanhToanText)): ?>
                                                        <small class="text-muted d-block"><?= $ngayThanhToanText ?></small>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="badge bg-primary"><?= htmlspecialchars($payment['phuong_thuc'] ?? '') ?></span>
                                            </div>
                                            <?php if (!empty($payment['ghi_chu'])): ?>
                                                <p class="mb-1 small text-muted"><?= htmlspecialchars($payment['ghi_chu']) ?></p>
                                            <?php endif; ?>

                                            <?php if (!empty($payment['anh_thanh_toan'])): ?>
                                                <div class="mt-1">
                                                    <a href="<?= htmlspecialchars($payment['anh_thanh_toan']) ?>" target="_blank">
                                                        <img src="<?= htmlspecialchars($payment['anh_thanh_toan']) ?>" alt="Ảnh thanh toán" class="img-thumbnail payment-proof-thumb">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0 text-center">Chưa có lịch sử thanh toán</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <p class="mb-0">Không tìm thấy booking.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Thêm thanh toán -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog payment-modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPaymentModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>Thêm thanh toán
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="?action=addPayment" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?? '' ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Số tiền <span class="text-danger">*</span></label>
                        <input type="text" id="so_tien_display" class="form-control" required placeholder="Nhập số tiền, chỉ dùng số">
                        <small class="form-text text-muted">Ví dụ: 1000000</small>
                        <small class="form-text text-muted d-block">Hiển thị: <span id="so_tien_preview"></span></small>
                        <input type="hidden" name="so_tien" id="so_tien_real" value="">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phương thức thanh toán <span class="text-danger">*</span></label>
                        <select name="phuong_thuc" class="form-select" required>
                            <option value="">-- Chọn phương thức --</option>
                            <option value="Chuyen Khoan">Chuyển khoản</option>
                            <option value="Tien Mat">Tiền mặt</option>
                            <option value="The">Thẻ</option>
                            <option value="Khac">Khác</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh minh chứng thanh toán</label>
                        <input type="file" name="anh_thanh_toan" id="anh_thanh_toan_input" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Tùy chọn, có thể upload biên lai/chụp màn hình thanh toán.</small>
                        <div class="mt-2" id="anh_thanh_toan_preview_wrapper" style="display:none;">
                            <span class="form-text d-block mb-1">Xem thử ảnh đã chọn:</span>
                            <img id="anh_thanh_toan_preview" src="" alt="Preview ảnh thanh toán" class="img-thumbnail payment-proof-thumb">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Nhập ghi chú (nếu có)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu thanh toán</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Định dạng số tiền trong modal Thêm thanh toán và kiểm tra không vượt quá số tiền còn nợ
(function() {
  const inputDisplay = document.getElementById('so_tien_display');
  const inputReal = document.getElementById('so_tien_real');
  const formPayment = document.querySelector('#addPaymentModal form');

  if (!inputDisplay || !inputReal || !formPayment) return;

  function parseNumber(str) {
    if (!str) return 0;
    const digits = str.toString().replace(/[^0-9]/g, '');
    if (!digits) return 0;
    return parseInt(digits, 10) || 0;
  }

  function formatNumber(num) {
    if (!num) return '';
    return num.toLocaleString('en-US');
  }

  const previewSpan = document.getElementById('so_tien_preview');

  // Khi đang gõ: chỉ cho phép chữ số và hiển thị phiên bản có dấu phẩy bên dưới
  inputDisplay.addEventListener('input', function() {
    const raw = inputDisplay.value;
    const value = parseNumber(raw);
    inputDisplay.value = value ? String(value) : '';
    if (previewSpan) {
      previewSpan.textContent = value ? formatNumber(value) : '';
    }
  });

  formPayment.addEventListener('submit', function(e) {
    const raw = inputDisplay.value;
    const value = parseNumber(raw);

    if (value <= 0) {
      alert('Vui lòng nhập số tiền thanh toán lớn hơn 0.');
      e.preventDefault();
      return;
    }

    // Tính số tiền còn nợ từ dữ liệu booking
    const tongTien = <?php echo (int)($booking['tong_tien_tour'] ?? 0); ?>;
    const daTra = <?php echo (int)($booking['da_thanh_toan'] ?? 0); ?>;
    const conNo = Math.max(tongTien - daTra, 0);

    if (conNo > 0 && value > conNo) {
      alert('Số tiền còn nợ hiện tại là ' + formatNumber(conNo) + ' đ.\n'
        + 'Bạn đang nhập ' + formatNumber(value) + ' đ, lớn hơn số tiền còn nợ.\n'
        + 'Vui lòng nhập lại số tiền không vượt quá số tiền còn nợ.');
      e.preventDefault();
      return;
    }

    inputReal.value = value;
  });
})();

// Preview ảnh thanh toán trước khi upload
(function() {
  const inputFile = document.getElementById('anh_thanh_toan_input');
  const previewImg = document.getElementById('anh_thanh_toan_preview');
  const wrapper = document.getElementById('anh_thanh_toan_preview_wrapper');

  if (!inputFile || !previewImg || !wrapper) return;

  inputFile.addEventListener('change', function() {
    const file = this.files && this.files[0] ? this.files[0] : null;
    if (!file) {
      wrapper.style.display = 'none';
      previewImg.src = '';
      return;
    }

    if (!file.type.startsWith('image/')) {
      alert('Vui lòng chọn file hình ảnh hợp lệ.');
      this.value = '';
      wrapper.style.display = 'none';
      previewImg.src = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
      previewImg.src = e.target.result;
      wrapper.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });
})();
</script>

<?php require_once "views/admin/layout/footer.php"; ?>
