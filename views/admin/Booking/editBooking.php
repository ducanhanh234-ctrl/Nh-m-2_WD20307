<?php require_once "views/admin/layout/header.php"; ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="bg-white rounded shadow-sm p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div>
        <h2 class="mb-1">Sửa booking</h2>
        <p class="text-muted mb-0">Cập nhật thông tin booking, lịch trình và hình ảnh</p>
      </div>
      <div class="d-flex gap-2">
        <a href="?action=manageBookings" class="btn btn-outline-secondary">← Quay lại</a>
        <button type="submit" form="bookingForm" class="btn btn-primary">Cập nhật booking</button>
      </div>
    </div>
  </div>

  <!-- Form with Accordion -->
  <div class="bg-white rounded shadow-sm">
    <form method="POST" action="?action=editNewBooking&id=<?= $getBookingId['id'] ?>" id="bookingForm">
      <div class="accordion" id="bookingAccordion">

        <!-- Section 1: Thông tin cơ bản -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#section1" aria-expanded="true">
              <span class="fw-bold me-2">1.</span> Thông tin cơ bản
            </button>
          </h2>
          <div id="section1" class="accordion-collapse collapse show">
            <div class="accordion-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Tên Khách <span class="text-danger">*</span></label>
                  <input type="text" name="tenkhach" class="form-control" value="<?= htmlspecialchars($getBookingId['tenkhach']) ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Giới Tính</label>
                  <select name="gioitinh" class="form-select">
                    <option value="">-- Chọn giới tính --</option>
                    <option value="nam" <?= ($getBookingId['gioitinh'] == 'nam') ? 'selected' : '' ?>>Nam</option>
                    <option value="nữ" <?= ($getBookingId['gioitinh'] == 'nữ') ? 'selected' : '' ?>>Nữ</option>
                    <option value="khác" <?= ($getBookingId['gioitinh'] == 'khác') ? 'selected' : '' ?>>Khác</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">SĐT <span class="text-danger">*</span></label>
                  <input type="number" name="sdt" class="form-control" value="<?= ($getBookingId['sdt']) ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" value="<?= ($getBookingId['email']) ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">CCCD / Số CMND</label>
                  <input type="text" name="cccd" class="form-control" value="<?= ($getBookingId['cccd'] ?? '') ?>" placeholder="0123456789">
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Section 2: Thông tin tour -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section2">
              <span class="fw-bold me-2">2.</span> Thông tin tour
            </button>
          </h2>
          <div id="section2" class="accordion-collapse collapse">
            <div class="accordion-body">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Tour <span class="text-danger">*</span></label>
                  <select name="tuor_id" id="tourSelect" class="form-select" required>
                    <option value="">-- Chọn tour --</option>
                    <?php foreach ($listTour as $item) : ?>
                      <option value="<?= $item['id'] ?>" 
                              data-thoigian="<?= ($item['phienban_thoigian'] ?? '') ?>" 
                              data-price="<?= ($item['phienban_price'] ?? 0) ?>"
                              <?= ($item['id'] == $getBookingId['tuor_id']) ? 'selected' : '' ?>>
                        <?= ($item['name']) ?> (<?= ($item['danhmuc_name']) ?>)
                      </option>
                    <?php endforeach ; ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Số Người <span class="text-danger">*</span></label>
                  <input type="number" name="soluong_nguoi" id="soluongNguoi" class="form-control" value="<?= htmlspecialchars($getBookingId['soluong_nguoi']) ?>" min="1" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Giá tour / 1 người</label>
                  <input type="text" id="giaTour" class="form-control" value="" readonly>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Tổng tiền tour (ước tính)</label>
                  <input type="text" id="tongTienTour" class="form-control" value="" readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Ngày khởi hành (dự kiến)</label>
                  <input type="date" name="ngaykhoi_hanh" class="form-control" value="<?= htmlspecialchars($getBookingId['ngaykhoi_hanh'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Số ngày</label>
                  <input type="text" id="songay" name="songay" class="form-control" value="<?= htmlspecialchars($getBookingId['songay'] ?? '') ?>" placeholder="Số ngày sẽ đi Vd: 3 ngày 2 đêm">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phương tiện di chuyển</label>
                  <select name="phuongtien_id" class="form-select">
                    <option value="">-- Chọn phương tiện --</option>
                    <?php if (!empty($listPhuongTien)): ?>
                      <?php foreach ($listPhuongTien as $pt): ?>
                        <option value="<?= $pt['id'] ?>" <?= (!empty($getBookingId['phuongtien_id']) && $getBookingId['phuongtien_id'] == $pt['id']) ? 'selected' : '' ?>>
                          <?= ($pt['name'] ?? '') ?> - <?= ($pt['ten_don_vi'] ?? '') ?> (<?= ($pt['nang_luc_cung_cap'] ?? '') ?>)
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Khách sạn</label>
                  <select name="khachsan_id" class="form-select">
                    <option value="">-- Chọn khách sạn --</option>
                    <?php if (!empty($listKhachSan)): ?>
                      <?php foreach ($listKhachSan as $ks): ?>
                        <option value="<?= $ks['id'] ?>" <?= (!empty($getBookingId['khachsan_id']) && $getBookingId['khachsan_id'] == $ks['id']) ? 'selected' : '' ?>>
                          <?= ($ks['ten_ks'] ?? '') ?> - <?= ($ks['ten_don_vi'] ?? '') ?> (<?= ($ks['nang_luc_cung_cap'] ?? '') ?>)
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Section 3: Danh sách khách hàng tham gia -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section3">
              <span class="fw-bold me-2">3.</span> Danh sách khách hàng tham gia
            </button>
          </h2>
          <div id="section3" class="accordion-collapse collapse">
            <div class="accordion-body">
              <h5 class="mb-3">Danh sách khách hiện tại</h5>

              <?php if (!empty($dsKhach) && is_array($dsKhach)) : ?>
                <div class="table-responsive mb-4">
                  <table class="table table-bordered table-sm">
                    <thead class="table-light">
                      <tr>
                        <th style="width: 40px;">STT</th>
                        <th>Họ và Tên</th>
                        <th style="width: 120px;">Ngày sinh</th>
                        <th style="width: 80px;">Giới tính</th>
                        <th style="width: 130px;">Số CMND/CCCD</th>
                        <th style="width: 120px;">Số điện thoại</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dsKhach as $index => $khach): ?>
                        <tr>
                          <td><?php echo $index + 1; ?></td>
                          <td><?php echo htmlspecialchars($khach['hovaten'] ?? ''); ?></td>
                          <td><?php echo htmlspecialchars($khach['ngaysinh'] ?? ''); ?></td>
                          <td><?php echo htmlspecialchars($khach['gioitinh'] ?? ''); ?></td>
                          <td><?php echo htmlspecialchars($khach['cccd'] ?? ''); ?></td>
                          <td><?php echo htmlspecialchars($khach['sdt'] ?? ''); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else: ?>
                <p class="text-muted">Chưa có danh sách khách chi tiết cho booking này.</p>
              <?php endif; ?>

              <h5 class="mb-3">Thêm khách mới</h5>
              <?php
                $existingCustomerCount = (!empty($dsKhach) && is_array($dsKhach)) ? count($dsKhach) : 0;
              ?>
              <p class="text-muted mb-2">
                Đã có <strong><?php echo $existingCustomerCount; ?></strong> khách chi tiết trong hệ thống.
                Tổng số khách chi tiết sau khi cập nhật sẽ phải đúng bằng giá trị <strong>Số Người</strong>.
              </p>
              <div class="customer-input-form mb-4 p-3 border rounded">
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
                    <button type="button" id="btnAddCustomerEdit" onclick="addCustomerEdit()" class="btn btn-primary btn-sm w-100">+ Thêm vào danh sách mới</button>
                  </div>
                </div>
              </div>

              <h6 class="mb-2">Danh sách khách mới sẽ thêm:</h6>
              <div class="table-responsive">
                <table class="table table-bordered table-sm">
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
                  <tbody id="customerTableEdit">
                  </tbody>
                </table>
              </div>

              <input type="hidden" name="danhsach_khach" id="danhsach_khach" value="">
            </div>
          </div>
        </div>

        <!-- Section 4: Yêu cầu đặc biệt -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section4">
              <span class="fw-bold me-2">4.</span> Yêu cầu đặc biệt
            </button>
          </h2>
          <div id="section4" class="accordion-collapse collapse">
            <div class="accordion-body">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Yêu Cầu Đặc Biệt</label>
                  <textarea name="yeucaudacbiet" class="form-control" rows="4" placeholder="Các bệnh lí, dị ứng, yêu cầu về phòng, ăn uống, v.v"><?php echo htmlspecialchars($getBookingId['yeucaudacbiet'] ?? ''); ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Auto-fill tour data & price
const tourSelect = document.getElementById('tourSelect');
const inputSongay = document.getElementById('songay');
const inputSoNguoi = document.getElementById('soluongNguoi');
const inputGiaTour = document.getElementById('giaTour');
const inputTongTienTour = document.getElementById('tongTienTour');

function formatVnd(value) {
  if (!value || isNaN(value)) return '';
  return Number(value).toLocaleString('vi-VN') + ' VND';
}

function updateTourInfo() {
  if (!tourSelect) return;
  const selectedOption = tourSelect.options[tourSelect.selectedIndex];
  if (!selectedOption) return;

  const thoigian = selectedOption.getAttribute('data-thoigian');
  const price = parseInt(selectedOption.getAttribute('data-price') || '0', 10);

  if (inputSongay) {
    inputSongay.value = thoigian || '';
  }

  if (inputGiaTour) {
    inputGiaTour.value = price > 0 ? formatVnd(price) : '';
  }

  updateTongTien();
}

function updateTongTien() {
  if (!inputTongTienTour || !inputSoNguoi || !tourSelect) return;
  const selectedOption = tourSelect.options[tourSelect.selectedIndex];
  if (!selectedOption) {
    inputTongTienTour.value = '';
    return;
  }

  const price = parseInt(selectedOption.getAttribute('data-price') || '0', 10);
  const soNguoi = parseInt(inputSoNguoi.value || '0', 10);

  if (!price || !soNguoi || price <= 0 || soNguoi <= 0) {
    inputTongTienTour.value = '';
    return;
  }

  const tong = price * soNguoi;
  inputTongTienTour.value = formatVnd(tong);
}

if (tourSelect) {
  tourSelect.addEventListener('change', updateTourInfo);
}

if (inputSoNguoi) {
  inputSoNguoi.addEventListener('input', function() {
    updateTongTien();
    // cũng cập nhật lại trạng thái nút thêm khách vì tổng người thay đổi
    updateAddButtonState();
  });
}

// Khởi tạo lại thông tin nếu đã có sẵn tour và số người (khi vào trang sửa)
updateTourInfo();

// Quản lý danh sách khách mới khi sửa booking
const listCustomerEdit = [];
const existingCustomerCount = <?php echo $existingCustomerCount; ?>;
const inputTotalPassengers = document.querySelector('input[name="soluong_nguoi"]');
const btnAddCustomerEdit = document.getElementById('btnAddCustomerEdit');

function getRequiredNewCustomerCount() {
  if (!inputTotalPassengers) return 0;
  const total = parseInt(inputTotalPassengers.value || '0', 10);
  if (isNaN(total) || total <= 0) return 0;
  if (total <= existingCustomerCount) return 0;
  return total - existingCustomerCount;
}

function updateAddButtonState() {
  if (!btnAddCustomerEdit) return;
  const requiredNew = getRequiredNewCustomerCount();
  btnAddCustomerEdit.disabled = (requiredNew === 0 || listCustomerEdit.length >= requiredNew);
}

function addCustomerEdit() {
  const name = document.getElementById('c_name').value;
  const birthday = document.getElementById('c_birthday').value;
  const gender = document.getElementById('c_gender').value;
  const cccd = document.getElementById('c_cccd').value;
  const phone = document.getElementById('c_phone').value;

  const requiredNew = getRequiredNewCustomerCount();
  if (requiredNew === 0) {
    alert('Số Người hiện tại không yêu cầu thêm khách mới (hoặc nhỏ hơn/ bằng số khách đã có).');
    return;
  }

  if (listCustomerEdit.length >= requiredNew) {
    alert('Bạn đã nhập đủ số khách mới cần thiết. Vui lòng tăng "Số Người" nếu muốn thêm nhiều khách hơn.');
    return;
  }

  if (!name.trim()) {
    alert('Vui lòng nhập họ và tên khách!');
    return;
  }

  listCustomerEdit.push({name, birthday, gender, cccd, phone});
  renderCustomerEdit();

  document.getElementById('c_name').value = '';
  document.getElementById('c_birthday').value = '';
  document.getElementById('c_gender').value = '';
  document.getElementById('c_cccd').value = '';
  document.getElementById('c_phone').value = '';
  updateAddButtonState();
}

function renderCustomerEdit() {
  const tbody = document.getElementById('customerTableEdit');
  tbody.innerHTML = '';

  listCustomerEdit.forEach((customer, index) => {
    const row = `
      <tr>
        <td>${index + 1}</td>
        <td>${customer.name}</td>
        <td>${customer.birthday || '-'}</td>
        <td>${customer.gender || '-'}</td>
        <td>${customer.cccd || '-'}</td>
        <td>${customer.phone || '-'}</td>
        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomerEdit(${index})">Xóa</button>
        </td>
      </tr>
    `;
    tbody.innerHTML += row;
  });
  updateAddButtonState();
}

function deleteCustomerEdit(index) {
  if (confirm('Bạn có chắc muốn xóa khách này khỏi danh sách mới?')) {
    listCustomerEdit.splice(index, 1);
    renderCustomerEdit();
  }
}

if (inputTotalPassengers) {
  inputTotalPassengers.addEventListener('change', function() {
    const total = parseInt(this.value || '0', 10);
    if (!isNaN(total) && total < existingCustomerCount) {
      alert('Số Người không thể nhỏ hơn số khách chi tiết đã có (' + existingCustomerCount + ').');
      this.value = existingCustomerCount;
    }
    updateAddButtonState();
  });
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
  const total = parseInt(inputTotalPassengers ? (inputTotalPassengers.value || '0') : '0', 10);
  const newCount = listCustomerEdit.length;
  const expectedTotal = existingCustomerCount + newCount;

  if (!isNaN(total) && total !== expectedTotal) {
    alert('Tổng số khách chi tiết (khách đã có + khách mới) phải đúng bằng Số Người.\n' +
          'Hiện tại: ' + existingCustomerCount + ' khách cũ + ' + newCount + ' khách mới = ' + expectedTotal +
          ', nhưng Số Người = ' + total + '.');
    e.preventDefault();
    return;
  }

  const jsonData = JSON.stringify(listCustomerEdit);
  document.getElementById('danhsach_khach').value = jsonData;
});

// Khởi tạo trạng thái nút thêm theo Số Người hiện tại
updateAddButtonState();
</script>

<?php require_once "views/admin/layout/footer.php"; ?>
