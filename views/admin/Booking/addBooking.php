<?php require_once "views/admin/layout/header.php"; ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="bg-white rounded shadow-sm p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div>
        <h2 class="mb-1">Thêm booking mới</h2>
        <p class="text-muted mb-0">Nhập đầy đủ thông tin tin booking, lịch trình, giá và hình ảnh</p>
      </div>
      <div class="d-flex gap-2">
        <a href="?action=manageBookings" class="btn btn-outline-secondary">← Quay lại</a>
        <button type="submit" form="bookingForm" class="btn btn-primary">Lưu booking</button>
      </div>
    </div>
  </div>

  <!-- Form with Accordion -->
  <div class="bg-white rounded shadow-sm">
    <form method="POST" action="?action=addNewBooking" id="bookingForm">
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
                  <input type="text" name="tenkhach" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Giới Tính</label>
                  <select name="gioitinh" class="form-select">
                    <option value="">-- Chọn giới tính --</option>
                    <option value="nam">Nam</option>
                    <option value="nữ">Nữ</option>
                    <option value="khác">Khác</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">SĐT <span class="text-danger">*</span></label>
                  <input type="number" name="sdt" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">CCCD / Số CMND</label>
                  <input type="text" name="cccd" class="form-control" placeholder="0123456789">
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
                      <option value="<?= $item['id'] ?>" data-thoigian="<?= ($item['phienban_thoigian'] ?? '') ?>" data-phuongtien="<?= ($item['phienban_phuongtien']) ?>"><?= ($item['name']) ?> (<?= ($item['danhmuc_name']) ?>)</option>
                    <?php endforeach ; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Số Người <span class="text-danger">*</span></label>
                  <input type="number" name="soluong_nguoi" class="form-control" min="1" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Ngày khởi hành (dự kiến)</label>
                  <input type="date" name="ngaykhoi_hanh" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Số ngày</label>
                  <input type="text" id="songay" name="songay" class="form-control" placeholder="Số ngày sẽ đi Vd: 3 ngày 2 đêm">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phương tiện di chuyển</label>
                  <input type="text" id="phuongtien" name="phuongtien" class="form-control" placeholder="VD: Máy bay, Ô tô">
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Section 3: Danh sách khách hàng -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section3">
              <span class="fw-bold me-2">3.</span> Danh sách khách hàng tham gia
            </button>
          </h2>
          <div id="section3" class="accordion-collapse collapse">
            <div class="accordion-body">
              <h5 class="mb-3">Danh sách khách đi tour</h5>

              <!-- Form nhập thông tin khách - Compact version -->
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
                      <option value="">-Chọn Giới Tính-</option>
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
                  <div class="col-md-2">
                    <label class="form-label form-label-sm">Ghi chú:</label>
                    <input type="text" id="c_note" class="form-control form-control-sm" placeholder="Ghi chú">
                  </div>
                  <div class="col-md-1 d-flex align-items-end">
                    <button type="button" onclick="addCustomer()" class="btn btn-primary btn-sm w-100">+ Thêm</button>
                  </div>
                </div>
              </div>

              <!-- Hiển thị danh sách khách tạm -->
              <h6 class="mb-2">Danh sách tạm thời:</h6>
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
                      <th>Ghi chú</th>
                      <th style="width: 100px;" class="text-center">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody id="customerTable">
                  </tbody>
                </table>
              </div>
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
                  <textarea name="yeucaudacbiet" class="form-control" rows="4" placeholder="Các bệnh lí, dị ứng, yêu cầu về phòng, ăn uống, v.v"></textarea>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="danhsach_khach" id="danhsach_khach" value="">
        </div>

      </div>
    </form>
  </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Auto-fill tour data
document.getElementById('tourSelect').addEventListener('change', function() {
  const selectedOption = this.options[this.selectedIndex];
  const thoigian = selectedOption.getAttribute('data-thoigian');
  const phuongtien = selectedOption.getAttribute('data-phuongtien');
  document.getElementById('songay').value = thoigian || '';
  document.getElementById('phuongtien').value = phuongtien || '';
});

// Quản lý danh sách khách hàng
const listCustomer = [];

function addCustomer() {
  const name = document.getElementById('c_name').value;
  const birthday = document.getElementById('c_birthday').value;
  const gender = document.getElementById('c_gender').value;
  const cccd = document.getElementById('c_cccd').value;
  const phone = document.getElementById('c_phone').value;
  const note = document.getElementById('c_note').value;
  
  // Kiểm tra validation cơ bản
  if (!name.trim()) {
    alert('Vui lòng nhập họ và tên!');
    return;
  }
  
  // Thêm vào danh sách
  listCustomer.push({name, birthday, gender, cccd, phone, note});
  
  // Render lại bảng
  renderCustomer();
  
  // Clear form
  document.getElementById('c_name').value = '';
  document.getElementById('c_birthday').value = '';
  document.getElementById('c_gender').value = '';
  document.getElementById('c_cccd').value = '';
  document.getElementById('c_phone').value = '';
  document.getElementById('c_note').value = '';
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
        <td>${customer.note || 'Ko có ghi chú'}</td>
        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomer(${index})">Xóa</button>
        </td>
      </tr>
    `;
    tbody.innerHTML += row;
  });
}


function deleteCustomer(index) {
  if (confirm('Bạn có chắc muốn xóa khách này?')) {
    listCustomer.splice(index, 1);
    renderCustomer();
  }
}


document.getElementById('bookingForm').addEventListener('submit', function(e) {
  const jsonData = JSON.stringify(listCustomer);
  document.getElementById('danhsach_khach').value = jsonData;
});
</script>

<?php require_once "views/admin/layout/footer.php"; ?>
