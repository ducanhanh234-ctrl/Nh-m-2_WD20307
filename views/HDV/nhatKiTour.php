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
        <h4 class="mb-1">Nhật ký tour</h4>
        <p class="text-muted small mb-0">Quản lý và theo dõi nhật ký các tour đã thực hiện</p>
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

    <!-- Phần Nhật ký -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Nhật ký</h5>
            <a href="?action=themNhatKiTour" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Thêm nhật ký
            </a>
        </div>
        <?php if (!empty($nhatKiTour) && is_array($nhatKiTour)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Ảnh</th>
                            <th style="width: 120px;">Khách booking</th>
                            <th style="width: 150px;">Tour</th>
                            <th style="width: 80px;">Ngày thứ</th>
                            <th>Hoạt động nổi bật</th>
                            <th>Sự cố</th>
                            <th>Cách xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nhatKiTour as $item): ?>
                            <tr>
                                <!-- Ảnh -->
                                <td>
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="<?= htmlspecialchars($item['image']) ?>" 
                                             alt="Hình ảnh" 
                                             class="img-thumbnail"
                                             style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal<?= $item['id'] ?>">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                             style="width: 70px; height: 70px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- Khách booking -->
                                <td>
                                    <small class="text-muted d-block"><?= htmlspecialchars($item['tenkhach'] ?? 'N/A') ?></small>
                                </td>

                                <!-- Tour -->
                                <td>
                                    <small><?= htmlspecialchars($item['tour_name'] ?? 'N/A') ?></small>
                                </td>

                                <!-- Ngày thứ -->
                                <td>
                                    <span class="badge bg-info"><?= htmlspecialchars($item['ngay_thu'] ?? 'N/A') ?></span>
                                </td>

                                <!-- Hoạt động nổi bật -->
                                <td>
                                    <?php 
                                    $hoat_dong = trim($item['hoat_dong_noi_bat'] ?? '');
                                    if (empty($hoat_dong)): ?>
                                        <small class="text-muted">Chưa có</small>
                                    <?php else: ?>
                                        <small><?= htmlspecialchars($hoat_dong) ?></small>
                                    <?php endif; ?>
                                </td>

                                <!-- Sự cố -->
                                <td>
                                    <?php 
                                    $su_co = trim($item['su_co'] ?? '');
                                    if (!empty($su_co)): ?>
                                        <small class="text-danger">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            <?= htmlspecialchars($su_co) ?>
                                        </small>
                                    <?php else: ?>
                                        <small class="text-muted">Không có sự cố</small>
                                    <?php endif; ?>
                                </td>

                                <!-- Cách xử lý -->
                                <td>
                                    <?php 
                                    $su_co = trim($item['su_co'] ?? '');
                                    $cach_xu_ly = trim($item['cach_xu_ly'] ?? '');
                                    if (!empty($su_co) && empty($cach_xu_ly)): ?>
                                        <button class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#xuLyModal<?= $item['id'] ?>">
                                            <i class="bi bi-pencil-square me-1"></i>Xử lý
                                        </button>
                                    <?php elseif (!empty($cach_xu_ly)): ?>
                                        <small class="text-success"><?= htmlspecialchars($cach_xu_ly) ?></small>
                                    <?php else: ?>
                                        <small class="text-muted">-</small>
                                    <?php endif; ?>
                                </td>

                            </tr>

                            <!-- Modal Xử lý -->
                            <?php 
                            $su_co_modal = trim($item['su_co'] ?? '');
                            $cach_xu_ly_modal = trim($item['cach_xu_ly'] ?? '');
                            if (!empty($su_co_modal) && empty($cach_xu_ly_modal)): ?>
                                <div class="modal fade" id="xuLyModal<?= $item['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Xử lý sự cố</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="?action=updateXuLy&id=<?= $item['id'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-2">
                                                        <label class="form-label small">Sự cố:</label>
                                                        <p class="form-control-plaintext small text-danger mb-0">
                                                            <?= htmlspecialchars($su_co_modal) ?>
                                                        </p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="cach_xu_ly<?= $item['id'] ?>" class="form-label small">
                                                            Cách xử lý <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control form-control-sm" 
                                                                  id="cach_xu_ly<?= $item['id'] ?>" 
                                                                  name="cach_xu_ly" 
                                                                  rows="3" 
                                                                  required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer py-2">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Modal Xem ảnh -->
                            <div class="modal fade" id="imageModal<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header py-2">
                                            <h6 class="modal-title">Hình ảnh nhật ký</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0 text-center">
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="<?= htmlspecialchars($item['image']) ?>" 
                                                     alt="Hình ảnh" 
                                                     class="img-fluid">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-journal-text display-4 text-muted"></i>
                <p class="text-muted mt-2">Không có nhật ký tour nào.</p>
            </div>
        <?php endif; ?>
    </div>

    
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once "views/admin/layout/footer.php"; ?>
