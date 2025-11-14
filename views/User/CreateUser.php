<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm nhân sự</title>
</head>
<body>

<h2>Thêm nhân sự</h2>

<form action="?action=storeUsers" method="POST">
    <label>Họ tên:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Ngày sinh:</label><br>
    <input type="date" name="ngaysinh" required><br><br>

    <label>Avatar (URL):</label><br>
    <input type="text" name="avatar"><br><br>

    <label>Số điện thoại:</label><br>
    <input type="text" name="sdt"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Chứng chỉ:</label><br>
    <input type="text" name="chungchi"><br><br>

    <label>Ngôn ngữ:</label><br>
    <input type="text" name="ngonngu"><br><br>

    <label>Kinh nghiệm:</label><br>
    <textarea name="kinhnghiem"></textarea><br><br>

    <label>Lịch sử dẫn tour:</label><br>
    <textarea name="lichsudantuor"></textarea><br><br>

    <label>Đánh giá năng lực:</label><br>
    <textarea name="danhgianangluc"></textarea><br><br>

    <label>Sức khỏe:</label><br>
    <textarea name="suckhoe"></textarea><br><br>

    <label>Loại HDV (ID):</label><br>
    <input type="number" name="loaihdv_id"><br><br>

    <label>Chức vụ:</label><br>
    <input type="text" name="chucvu"><br><br>

    <button type="submit">Lưu</button>
</form>

</body>
</html>
