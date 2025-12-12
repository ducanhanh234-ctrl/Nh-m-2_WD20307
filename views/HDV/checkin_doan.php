<?php
require_once "views/HDV/layout/header.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Điểm danh đoàn - Tour #<?= htmlspecialchars($tuor_id ?? '') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .da-den { background-color: #d4edda !important; }
        .vang   { background-color: #f8d7da !important; }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">

    <h2 class="text-center text-primary mb-4">
        ĐIỂM DANH ĐOÀN - TOUR #<?= htmlspecialchars($tuor_id) ?>
    </h2>

    <a href="index.php?action=hdv" class="btn btn-secondary mb-4">
        ← Quay lại danh sách tour
    </a>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=hdv-save" class="bg-white p-4 rounded  mb-5">
        <div class="mb-4">
            <?php $lichtrinh_hien_tai = $lichtrinh_id ?? 0;
                  $ds_chang = $cac_chang ?? []; ?>
            <label class="form-label mb-1">Chọn chặng / địa điểm điểm danh</label>
            <select class="form-select form-select-sm"
                    onchange="window.location='index.php?action=hdv-checkin&tuor_id=<?= $tuor_id ?>&lichtrinh_id='+encodeURIComponent(this.value)">
                <?php foreach ($ds_chang as $c): ?>
                    <option value="<?= htmlspecialchars($c['lichtrinh_id']) ?>" <?= ($c['lichtrinh_id'] == $lichtrinh_hien_tai) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['diadiem']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="tuor_id" value="<?= $tuor_id ?>">
        <input type="hidden" name="lichtrinh_id" value="<?= htmlspecialchars($lichtrinh_hien_tai) ?>">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="5%">STT</th>
                        <th>Họ tên</th>
                        <th>CCCD</th>
                        <th>SĐT</th>
                        <th width="15%">Trạng thái</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1; 
                    while($row = $khach_list->fetch(PDO::FETCH_ASSOC)): 
                        $class = ($row['trangthai_check']==2) ? 'da-den' : (($row['trangthai_check']==3) ? 'vang' : '');
                    ?>
                    <tr class="<?= $class ?>">
                        <td class="text-center"><?= $i++ ?></td>
                        <td><strong><?= htmlspecialchars($row['hoten']) ?></strong></td>
                        <td><?= htmlspecialchars($row['cccd'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['sdt'] ?? '') ?></td>
                        <td>
                            <select name="trangthai[<?= $row['khach_id'] ?>]" class="form-select form-select-sm">
                                <option value="1" <?= ($row['trangthai_check']!=2 && $row['trangthai_check']!=3)?'selected':'' ?>>Chưa đến</option>
                                <option value="2" <?= $row['trangthai_check']==2?'selected':'' ?>>Đã đến</option>
                                <option value="3" <?= $row['trangthai_check']==3?'selected':'' ?>>Vắng mặt</option>
                            </select>
                            <input type="hidden" name="khach_id[]" value="<?= $row['khach_id'] ?>">
                        </td>
                        <td>
                            <input type="text" name="ghichu[<?= $row['khach_id'] ?>]" 
                                   class="form-control form-control-sm"
                                   value="<?= htmlspecialchars($row['ghichu'] ?? '') ?>">
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg px-5">LƯU ĐIỂM DANH CHẶNG NÀY</button>
        </div>
    </form>

    <!-- DANH SÁCH CÁC CHẶNG ĐÃ ĐIỂM DANH -->
    <?php 
    // Biến đúng là $cac_chang (đã được truyền từ Controller)
    $ds_chang = $cac_chang ?? []; 
    if (!empty($ds_chang)): 
    ?>
    <div class="mt-5 p-4 bg-light rounded">
        <h5 class="mb-3">Các chặng đã điểm danh:</h5>
        <?php foreach($ds_chang as $c): ?>
            <a href="index.php?action=hdv-checkin&tuor_id=<?= $tuor_id ?>&lichtrinh_id=<?= urlencode($c['lichtrinh_id']) ?>"
               class="btn btn-outline-primary btn-sm me-2 mb-2">
               <?= htmlspecialchars($c['diadiem']) ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
require_once "views/admin/layout/footer.php";
?>