<?php
require_once "views/admin/layout/header.php";
?>

<style>
    table { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
    th { background: #eee; }
    a.btn { padding: 6px 12px; background: #0099ff; color:white; text-decoration:none; border-radius:4px; }
    a.btn-red { background:red; color:white; }
    .btn { padding: 5px 10px; text-decoration: none; display: inline-block; margin-right: 10px; }
</style>

<h1>Danh sách phản hồi đánh giá</h1>
<div class="table_qlpbt">
    <a class="btn" href="index.php?action=phanhoi-create">Thêm mới phản hồi</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nội dung</th>
            <th>Tour</th>
            <th>Dịch vụ</th>
            <th>Nhà cung cấp</th>
            <th>Mức độ hài lòng</th>
            <th>Ngày tạo</th>
            <th>Người Gửi</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($feedbacks as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['noidung']) ?></td>
            <td><?= htmlspecialchars($row['ten_tour']) ?></td>
            <td><?= htmlspecialchars($row['ten_dichvu']) ?></td>
            <td><?= htmlspecialchars($row['ten_nhacungcap']) ?></td>
            <td><?= $row['muc_do_hai_long'] ?>/5</td>
            <td><?= $row['ngay_tao'] ?></td>
            <td><?= htmlspecialchars($row['nguoi_gui']) ?></td>
            <td>
                <a class="btn" href="index.php?action=phanhoi-edit&id=<?= $row['id'] ?>">Sửa</a>
                <a class="btn-red" href="index.php?action=phanhoi-delete&id=<?= $row['id'] ?>"
                   onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
require_once "views/admin/layout/footer.php";
?>
