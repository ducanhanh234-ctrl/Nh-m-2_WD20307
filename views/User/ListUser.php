<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách nhân sự</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; border: 1px solid #ccc; }
        th { background: #eee; }
        a.btn { padding: 6px 12px; background: #0099ff; color:white; text-decoration:none; border-radius:4px; }
        a.btn-red { background:red; }
        img { width: 60px; }
    </style>
</head>
<body>

<h2>Danh sách nhân sự</h2>

<a href="?action=createUsers" class="btn">+ Thêm nhân sự</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Avatar</th>
        <th>SĐT</th>
        <th>Email</th>
        <th>Chứng chỉ</th>
        <th>Ngôn ngữ</th>
        <th>Kinh nghiệm</th>
        <th>Lịch sử dẫn tour</th>
        <th>Đánh giá năng lực</th>
        <th>Sức khoẻ</th>
        <th>Loại HDV</th>
        <th>Chức vụ</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['ngaysinh'] ?></td>
        <td><img src="<?= $user['avatar'] ?>"></td>
        <td><?= $user['sdt'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['chungchi'] ?></td>
        <td><?= $user['ngonngu'] ?></td>
        <td><?= $user['kinhnghiem'] ?></td>
        <td><?= $user['lichsudantuor'] ?></td>
        <td><?= $user['danhgianangluc'] ?></td>
        <td><?= $user['suckhoe'] ?></td>
        <td><?= $user['loaihdv_name'] ?></td>
        <td><?= $user['chucvu'] ?></td>
        <td>
            <a href="?action=editUsers&id=<?= $user['id'] ?>" class="btn">Sửa</a>
            <br>
            <a href="?action=deleteUsers&id=<?= $user['id'] ?>" onclick="return confirm('Xóa nhân sự này?')" class="btn btn-red">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
