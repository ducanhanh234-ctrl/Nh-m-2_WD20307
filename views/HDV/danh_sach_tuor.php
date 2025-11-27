<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Xin chào HDV! Chọn tour để điểm danh</h2>
    <div class="mt-4">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Mã Tour</th>
                    <th>Tên Tour</th>
                    <th>Ngày khởi hành</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tours as $t): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= htmlspecialchars($t['tentour']) ?></td>
                    <td><?= date('d/m/Y', strtotime($t['ngaykhoi_hanh'])) ?></td>
                    <td><a href="?action=hdv-checkin&tuor_id=<?= $t['id'] ?>" class="btn btn-success">Điểm danh</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>