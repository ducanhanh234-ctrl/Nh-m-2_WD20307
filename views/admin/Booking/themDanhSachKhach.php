<?php require_once "views/admin/layout/header.php"; ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="container-fluid p-4">
    <!-- Header -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Thêm danh sách khách cho Booking</h2>
                <p class="text-muted mb-0">Booking của khách: <?= ($booking['tenkhach'] ?? '') ?></p>
            </div>
            <a class="btn btn-outline-secondary" href="?action=xemChiTietBooking&id=<?= $booking['id'] ?>">← Quay lại chi tiết booking</a>
        </div>
    </div>

    <form method="POST" action="?action=storeDanhSachKhach&id=<?= $booking['id'] ?>" id="formThemKhach">
        <!-- Form nhập thông tin khách - dùng lại style từ addBooking -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Thêm khách mới</h4>
                <div class="row g-2">
                <div class="col-md-2">
                    <label class="form-label form-label-sm">Họ và tên:</label>
                    <input type="text" id="c_name" class="form-control form-control-sm" placeholder="Nhập tên khách">
                </div>
                <div class="col-md-2">
                    <label class="form-label form-label-sm">Ngày sinh:</label>
                    <input type="date" id="c_birthday" class="form-control form-control-sm">
                </div>
                <div class="col-md-1">
                    <label class="form-label form-label-sm">Giới tính:</label>
                    <select id="c_gender" class="form-select form-select-sm">
                        <option value="">-Chọn-</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label form-label-sm">Số CMND/CCCD:</label>
                    <input type="text" id="c_cccd" class="form-control form-control-sm" placeholder="Số CMND/CCCD">
                </div>
                <div class="col-md-2">
                    <label class="form-label form-label-sm">Số điện thoại:</label>
                    <input type="text" id="c_phone" class="form-control form-control-sm" placeholder="Số ĐT">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" onclick="addCustomer()" class="btn btn-primary btn-sm w-100">+ Thêm vào danh sách tạm</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Hiển thị danh sách khách tạm sẽ thêm -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Danh sách khách sẽ thêm</h4>
                <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">STT</th>
                            <th>Họ và Tên</th>
                            <th style="width: 120px;">Ngày sinh</th>
                            <th style="width: 80px;">Giới tính</th>
                            <th style="width: 130px;">Số CMND/CCCD</th>
                            <th style="width: 120px;">Số điện thoại</th>
                            <th style="width: 80px;" class="text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="customerTable">
                    </tbody>
                </table>
                </div>

                <input type="hidden" name="danhsach_khach" id="danhsach_khach" value="">
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">Lưu danh sách khách</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Danh sách khách đã có (nếu muốn xem nhanh) -->
    <?php if (!empty($dsKhach) && is_array($dsKhach)): ?>
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
            <h4 class="mb-3">Danh sách khách đã có cho booking này</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>CCCD</th>
                            <th>SĐT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dsKhach as $index => $khach): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= ($khach['hovaten'] ?? '') ?></td>
                                <td><?= ($khach['ngaysinh'] ?? '') ?></td>
                                <td><?= ($khach['gioitinh'] ?? '') ?></td>
                                <td><?= ($khach['cccd'] ?? '') ?></td>
                                <td><?= ($khach['sdt'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
const listCustomer = [];

function addCustomer() {
  const name = document.getElementById('c_name').value;
  const birthday = document.getElementById('c_birthday').value;
  const gender = document.getElementById('c_gender').value;
  const cccd = document.getElementById('c_cccd').value;
  const phone = document.getElementById('c_phone').value;

  if (!name.trim()) {
    alert('Vui lòng nhập họ và tên!');
    return;
  }

  listCustomer.push({name, birthday, gender, cccd, phone});
  renderCustomer();

  document.getElementById('c_name').value = '';
  document.getElementById('c_birthday').value = '';
  document.getElementById('c_gender').value = '';
  document.getElementById('c_cccd').value = '';
  document.getElementById('c_phone').value = '';
}

function renderCustomer() {
  const tbody = document.getElementById('customerTable');
  tbody.innerHTML = '';

  listCustomer.forEach((customer, index) => {
    const row = `
      <tr>
        <td>${index + 1}</td>
        <td>${customer.name}</td>
        <td>${customer.birthday || '-'}</td>
        <td>${customer.gender || '-'}</td>
        <td>${customer.cccd || '-'}</td>
        <td>${customer.phone || '-'}</td>
        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomer(${index})">Xóa</button>
        </td>
      </tr>
    `;
    tbody.innerHTML += row;
  });
}

function deleteCustomer(index) {
  if (confirm('Bạn có chắc muốn xóa khách này khỏi danh sách tạm?')) {
    listCustomer.splice(index, 1);
    renderCustomer();
  }
}

document.getElementById('formThemKhach').addEventListener('submit', function(e) {
  if (listCustomer.length === 0) {
    if (!confirm('Chưa có khách nào trong danh sách tạm, bạn có chắc muốn lưu không?')) {
      e.preventDefault();
      return;
    }
  }
  const jsonData = JSON.stringify(listCustomer);
  document.getElementById('danhsach_khach').value = jsonData;
});
</script>

<?php require_once "views/admin/layout/footer.php"; ?>


