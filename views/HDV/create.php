<?php
require_once "views/HDV/layout/header.php";
?>

<style>
    form { background: #fff; padding: 20px; border-radius: 6px; max-width: 700px; }
    label { display: block; margin-top: 10px; font-weight: 500; }
    textarea, input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
    button { padding: 8px 15px; background-color: #0099ff; color: white; border: none; border-radius: 4px; margin-top: 15px; cursor: pointer; }
    button:hover { background-color: #007acc; }
</style>

<h1>Thêm phản hồi mới</h1>

<h1>Thêm phản hồi đánh giá</h1>

<form action="index.php?action=phanhoi-store" method="POST">
     
    <div class="form-group">
        <label>Người Gửi Phản Hồi:</label>
        <select name="nguoi_gui" id="">
            <option value="HDV" selected>HDV</option>
            <option value="Khách Hàng">Khách Hàng</option>
        </select>
    </div>

    <div class="form-group">
        <label>Nội dung phản hồi:</label>
        <textarea name="noidung" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Chọn tour:</label>
        <select name="tuor_id" class="form-control" required>
            <option value="">-- Chọn tour --</option>
            <?php foreach ($tours as $t): ?>
                <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Dịch vụ tour:</label>
        <select name="dichvu_tuor_id" class="form-control" required>
            <option value="">-- Chọn dịch vụ --</option>
            <?php foreach ($dichvus as $dv): ?>
                <option value="<?= $dv['id'] ?>"><?= $dv['loai_dichvu_tuor'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Nhà cung cấp:</label>
        <select name="nhacungcap_id" class="form-control" required>
            <option value="">-- Chọn nhà cung cấp --</option>
            <?php foreach ($nhacungcaps as $ncc): ?>
                <option value="<?= $ncc['id'] ?>"><?= $ncc['ten_don_vi'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Mức độ hài lòng:</label>
        <select name="muc_do_hai_long" class="form-control" required>
            <option value="">-- Chọn mức độ --</option>
            <option value="1">1 - Không hài lòng</option>
            <option value="2">2 - Tạm được</option>
            <option value="3">3 - Bình thường</option>
            <option value="4">4 - Hài lòng</option>
            <option value="5">5 - Rất hài lòng</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Lưu phản hồi</button>
</form>


<?php
require_once "views/admin/layout/footer.php";
?>
