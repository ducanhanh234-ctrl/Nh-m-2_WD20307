<?php
require_once "views/admin/layout/header.php";
?>

<style>
    form { background: #fff; padding: 20px; border-radius: 6px; max-width: 700px; margin: 20px auto; }
    label { display: block; margin-top: 10px; font-weight: 500; }
    textarea, input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
    button { padding: 8px 15px; background-color: #0099ff; color: white; border: none; border-radius: 4px; margin-top: 15px; cursor: pointer; }
    button:hover { background-color: #007acc; }
    a.cancel-btn { margin-left: 10px; color: #555; text-decoration: none; font-size: 14px; }
</style>

<h1>Sửa phản hồi</h1>

<form action="index.php?action=phanhoi-update&id=<?= $feedback['id'] ?>" method="POST">
    <div class="form-group">
        <label>Người Gửi Phản Hồi:</label>
        <select name="nguoi_gui" id="">
            <option value="HDV" selected>HDV</option>
            <option value="Khách Hàng">Khách Hàng</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nội dung phản hồi:</label>
        <textarea name="noidung" class="form-control" required><?= htmlspecialchars($feedback['noidung']) ?></textarea>
    </div>

    <div class="form-group">
        <label>Chọn tour:</label>
        <select name="tuor_id" class="form-control" required>
            <option value="">-- Chọn tour --</option>
            <?php foreach ($tours as $t): ?>
                <option value="<?= $t['id'] ?>" <?= $t['id'] == $feedback['tuor_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Dịch vụ tour:</label>
        <select name="dichvu_tuor_id" class="form-control" required>
            <option value="">-- Chọn dịch vụ --</option>
            <?php foreach ($dichvus as $dv): ?>
                <option value="<?= $dv['id'] ?>" <?= $dv['id'] == $feedback['dichvu_tuor_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dv['loai_dichvu_tuor']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Nhà cung cấp:</label>
        <select name="nhacungcap_id" class="form-control" required>
            <option value="">-- Chọn nhà cung cấp --</option>
            <?php foreach ($nhacungcaps as $ncc): ?>
                <option value="<?= $ncc['id'] ?>" <?= $ncc['id'] == $feedback['nhacungcap_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ncc['ten_don_vi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Mức độ hài lòng:</label>
        <select name="muc_do_hai_long" class="form-control" required>
            <option value="">-- Chọn mức độ --</option>
            <?php for($i=1; $i<=5; $i++): ?>
                <option value="<?= $i ?>" <?= $i == $feedback['muc_do_hai_long'] ? 'selected' : '' ?>>
                    <?= $i ?> <?= match($i) {
                        1 => '- Không hài lòng',
                        2 => '- Tạm được',
                        3 => '- Bình thường',
                        4 => '- Hài lòng',
                        5 => '- Rất hài lòng'
                    } ?>
                </option>
            <?php endfor; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="index.php?action=phanhoi-list" class="cancel-btn">Hủy</a>
</form>

<?php
require_once "views/admin/layout/footer.php";
?>
