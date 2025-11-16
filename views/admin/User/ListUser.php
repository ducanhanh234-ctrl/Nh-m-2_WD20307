<?php
require_once "views/admin/layout/header.php";
?>
<div class="chart">
  <h3>Danh sách nhân sự</h3>
  <div class="button-group">
    <a href="?action=createUsers" class="them_style_btn">+ Thêm nhân sự</a>
  </div>
</div>
<div class="table_qlpbt">
  <table class="styled-table">
    <thead>
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
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['ngaysinh'] ?></td>
       <td>
        <?php if (!empty($user['avatar'])): ?>
            <img src="<?= $user['avatar'] ?>" alt="" style="width:80px; height:80px; object-fit:cover; border-radius:5px;">
        <?php else: ?>
            <span>Chưa có ảnh</span>
        <?php endif; ?>
    </td>
        <td><?= $user['sdt'] ?></td>
        <td><?= $user['email'] ?></td>
        <td> <img src="<?= $user['chungchi'] ?>" alt="" style="width:80px; height:80px; object-fit:cover; border-radius:5px;"></td>
        <td><?= $user['ngonngu'] ?></td>
        <td><?= $user['kinhnghiem'] ?></td>
        <td><?= $user['lichsudantuor'] ?></td>
        <td><?= $user['danhgianangluc'] ?></td>
        <td><?= $user['suckhoe'] ?></td>
        <td><?= $user['loaihdv_name'] ?></td>
        <td><?= $user['chucvu'] ?></td>
        <td class="action">
            <a href="?action=editUsers&id=<?= $user['id'] ?>" class="sua_style_btn">Sửa</a>
            <a href="?action=deleteUsers&id=<?= $user['id'] ?>" onclick="return confirm('Xóa nhân sự này?')" class="xoa_style_btn">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
require_once "views/admin/layout/footer.php";
?>

