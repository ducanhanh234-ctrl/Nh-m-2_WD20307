<<<<<<< HEAD:views/admin/User/EditUser.php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa nhân sự</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css">
=======
<?php require_once "views/admin/header.php"; ?>
>>>>>>> quang-huy:views/User/EditUser.php

<style>
    .form-box {
        background: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        max-width: 700px;
    }

    label {
        font-weight: 500;
        margin-top: 10px;
        display: block;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea,
    select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    img.preview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-top: 5px;
    }

    .btn {
        padding: 6px 12px;
        margin-top: 15px;
        background: #0099ff;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
    }

    .btn-red {
        background: #e53935;
    }
</style>

<h2>Sửa thông tin nhân sự</h2>

<div class="form-box">

    <form action="?action=updateUsers&id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">

        <label>Họ tên:</label>
        <input type="text" name="name" value="<?= $user['name'] ?>" required>

        <label>Ngày sinh:</label>
        <input type="date" name="ngaysinh" value="<?= $user['ngaysinh'] ?>" required>

        <label>Avatar:</label>
        <input type="file" name="avatar">
        <?php if (!empty($user['avatar'])): ?>
            <img src="<?= $user['avatar'] ?>" class="preview">
        <?php endif; ?>

        <label>SĐT:</label>
        <input type="text" name="sdt" value="<?= $user['sdt'] ?>">

        <label>Email:</label>
        <input type="text" name="email" value="<?= $user['email'] ?>">

        <label>Chứng chỉ (ảnh):</label>
        <input type="file" name="chungchi">
        <?php if (!empty($user['chungchi'])): ?>
            <img src="<?= $user['chungchi'] ?>" class="preview">
        <?php endif; ?>

        <label>Ngôn ngữ:</label>
        <input type="text" name="ngonngu" value="<?= $user['ngonngu'] ?>">

        <label>Kinh nghiệm:</label>
        <textarea name="kinhnghiem" rows="3"><?= $user['kinhnghiem'] ?></textarea>

        <label>Lịch sử dẫn tour:</label>
        <textarea name="lichsudantuor" rows="3"><?= $user['lichsudantuor'] ?></textarea>

        <label>Đánh giá năng lực:</label>
        <textarea name="danhgianangluc" rows="3"><?= $user['danhgianangluc'] ?></textarea>

        <label>Sức khoẻ:</label>
        <input type="text" name="suckhoe" value="<?= $user['suckhoe'] ?>">

        <label>Loại HDV:</label>
        <select name="loaihdv_id">
            <?php foreach ($loaiHDV as $item): ?>
                <option value="<?= $item['id'] ?>" 
                    <?= ($item['id'] == $user['loaihdv_id']) ? 'selected' : '' ?>>
                    <?= $item['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Chức vụ:</label>
        <input type="text" name="chucvu" value="<?= $user['chucvu'] ?>">

        <br>
        <button type="submit" class="btn">Cập nhật</button>
        <a href="?action=listUsers" class="btn btn-red">Huỷ</a>
    </form>

</div>

<?php require_once "views/admin/footer.php"; ?>
