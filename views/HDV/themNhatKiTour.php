<?php
require_once "views/HDV/layout/header.php";
?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./assets/style/HDVCSS/HDV.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid p-3">
    <div class="mb-3">
        <div class="d-flex align-items-center mb-2">
            <a href="?action=nhatKiTour" class="btn btn-sm btn-outline-secondary me-2">
                <i class="bi bi-arrow-left me-1"></i>Quay lại
            </a>
            <h4 class="mb-0">Thêm nhật ký tour</h4>
        </div>
        <p class="text-muted small mb-0">Điền thông tin để thêm nhật ký mới</p>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
            <small><?= htmlspecialchars($_SESSION['success_message']) ?></small>
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
            <small><?= htmlspecialchars($_SESSION['error_message']) ?></small>
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form method="POST" action="?action=addNhatKy" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="booking_id" class="form-label">
                            Booking <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="booking_id" name="booking_id" required>
                            <option value="">-- Chọn booking --</option>
                            <?php if (!empty($listBooking) && is_array($listBooking)): ?>
                                <?php foreach ($listBooking as $booking): ?>
                                    <option value="<?= $booking['id'] ?>">
                                        <?= htmlspecialchars($booking['tenkhach'] ?? '') ?> - 
                                        <?= htmlspecialchars($booking['tour_name'] ?? '') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="ngay_thu" class="form-label">
                            Ngày thứ <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" 
                               id="ngay_thu" name="ngay_thu" 
                               min="1" required>
                    </div>

                    <div class="col-12">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" 
                               id="image" name="image" 
                               accept="image/*">
                        <small class="text-muted">Chọn ảnh của tour để upload</small>
                    </div>

                    <div class="col-12">
                        <label for="hoat_dong_noi_bat" class="form-label">Hoạt động nổi bật</label>
                        <textarea class="form-control" 
                                  id="hoat_dong_noi_bat" name="hoat_dong_noi_bat" 
                                  rows="3" 
                                  placeholder="Nhập các hoạt động nổi bật trong ngày..."></textarea>
                    </div>

                    <div class="col-12">
                        <label for="su_co" class="form-label">Sự cố</label>
                        <textarea class="form-control" 
                                  id="su_co" name="su_co" 
                                  rows="3" 
                                  placeholder="Nhập các sự cố xảy ra (nếu có)..."></textarea>
                    </div>

                    <div class="col-12">
                        <label for="cach_xu_ly" class="form-label">Cách xử lý</label>
                        <textarea class="form-control" 
                                  id="cach_xu_ly" name="cach_xu_ly" 
                                  rows="3" 
                                  placeholder="Nhập cách xử lý sự cố (nếu có)..."></textarea>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Thêm nhật ký
                            </button>
                            <a href="?action=nhatKiTour" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Hủy
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once "views/admin/layout/footer.php"; ?>

