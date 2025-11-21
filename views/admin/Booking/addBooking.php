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


        <!-- Section 3: Thông tin bổ sung -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section3">
              <span class="fw-bold me-2">3.</span> Thông tin bổ sung
            </button>
          </h2>
          <div id="section3" class="accordion-collapse collapse">
            <div class="accordion-body">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Danh sách khách hàng</label>
                  <textarea name="danhsachkhachhang" class="form-control" rows="4" placeholder="Danh sách những người đi tour (Nếu có)"></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label">Yêu Cầu Đặc Biệt</label>
                  <textarea name="yeucaudacbiet" class="form-control" rows="4" placeholder="Các bệnh lí, dị ứng, v.v"></textarea>
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
// Auto-fill tour data
document.getElementById('tourSelect').addEventListener('change', function() {
  const selectedOption = this.options[this.selectedIndex];
  const thoigian = selectedOption.getAttribute('data-thoigian');
  const phuongtien = selectedOption.getAttribute('data-phuongtien');
  document.getElementById('songay').value = thoigian || '';
  document.getElementById('phuongtien').value = phuongtien || '';
});
</script>

<?php require_once "views/admin/layout/footer.php"; ?>
