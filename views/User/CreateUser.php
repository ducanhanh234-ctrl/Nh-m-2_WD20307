<?php require_once "views/admin/header.php"; ?>

<style>
.form-box {
    background: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    max-width: 700px;
}
label { font-weight: 500; margin-top: 10px; display: block; }
input[type="text"], input[type="date"], input[type="file"], textarea, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
img.preview { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-top: 5px; }
.btn { padding: 6px 12px; margin-top: 15px; background: #0099ff; color: #fff; text-decoration: none; border-radius: 4px; display: inline-block; }
.btn-red { background: #e53935; }
</style>

<h2>Thêm nhân sự mới</h2>
<div class="form-box">
<form action="?action=storeUsers" method="POST" enctype="multipart/form-data">

    <label>Họ tên:</label>
    <input type="text" name="name" required>

    <label>Ngày sinh:</label>
    <input type="date" name="ngaysinh" required>

    <label>Avatar:</label>
    <input type="file" name="avatar">

    <label>SĐT:</label>
    <input type="text" name="sdt">

    <label>Email:</label>
    <input type="text" name="email">

    <label>Chứng chỉ (ảnh):</label>
    <input type="file" name="chungchi">

    <label>Ngôn ngữ:</label>
    <input type="text" name="ngonngu">

    <label>Kinh nghiệm:</label>
    <textarea name="kinhnghiem" rows="3"></textarea>

    <label>Lịch sử dẫn tour:</label>
    <textarea name="lichsudantuor" rows="3"></textarea>

    <label>Đánh giá năng lực:</label>
    <textarea name="danhgianangluc" rows="3"></textarea>

    <label>Sức khoẻ:</label>
    <input type="text" name="suckhoe">

    <label>Loại HDV:</label>
    <select name="loaihdv_id" required>
        <?php foreach ($loaiHDV as $item): ?>
            <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Chức vụ:</label>
    <input type="text" name="chucvu">

    <br>
    <button type="submit" class="btn">Thêm mới</button>
    <a href="?action=listUsers" class="btn btn-red">Huỷ</a>
</form>
</div>

<?php require_once "views/admin/footer.php"; ?>
