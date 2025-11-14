<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa nhân sự</title>
</head>
<body>

<h2>Sửa nhân sự</h2>

<form action="?action=updateUsers&id=<?= $user['id'] ?>" method="POST">
    <label>Họ tên:</label><br>
    <input type="text" name="name" value="<?= $user['name'] ?>"><br><br>

    <label>Ngày sinh:</label><br>
    <input type="date" name="ngaysinh" value="<?= $user['ngaysinh'] ?>"><br><br>

    <label>Avatar (URL):</label><br>
    <input type="text" name="avatar" value="<?= $user['avatar'] ?>"><br><br>

    <label>Số điện thoại:</label><br>
    <input type="text" name="sdt" value="<?= $user['sdt'] ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>

    <label>Chứng chỉ:</label><br>
    <input type="text" name="chungchi" value="<?= $user['chungchi'] ?>"><br><br>

    <label>Ngôn ngữ:</label><br>
    <input type="text" name="ngonngu" value="<?= $user['ngonngu'] ?>"><br><br>

    <label>Kinh nghiệm:</label><br>
    <textarea name="kinhnghiem"><?= $user['kinhnghiem'] ?></textarea><br><br>

    <label>Lịch sử dẫn tour:</label><br>
    <textarea name="lichsudantuor"><?= $user['lichsudantuor'] ?></textarea><br><br>

    <label>Đánh giá năng lực:</label><br>
    <textarea name="danhgianangluc"><?= $user['danhgianangluc'] ?></textarea><br><br>

    <label>Sức khỏe:</label><br>
    <textarea name="suckhoe"><?= $user['suckhoe'] ?></textarea><br><br>

    <label>Loại HDV (ID):</label><br>
    <input type="number" name="loaihdv_id" value="<?= $user['loaihdv_id'] ?>"><br><br>

    <label>Chức vụ:</label><br>
    <input type="text" name="chucvu" value="<?= $user['chucvu'] ?>"><br><br>

    <button type="submit">Cập nhật</button>
</form>

</body>
</html>
