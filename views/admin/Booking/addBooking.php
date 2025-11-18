<?php require_once "views/admin/layout/header.php"; ?>
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/booking.css">

<div class="add-booking-container">
  <div class="add-booking-header">
    <a class="phanphong_style_btn" href="?action=manageBookings">← Quay lại</a>
  </div>

  <div class="add-booking-form-wrapper">
    <h3>Thêm Booking Mới</h3>
    
    <form method="POST" action="?action=addNewBooking" class="booking-form" id="bookingForm">
      
      <div class="form-group">
        <label>Tên Khách:</label>
        <input type="text" name="tenkhach" required>
      </div>

      <div class="form-group">
        <label>SĐT:</label>
        <input type="number" name="sdt" required>
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
      </div>

        <div class="form-group">
          <label>CCCD / Số CMND:</label>
          <input type="text" name="cccd" placeholder="0123456789">
        </div>

       

      <div class="form-group">
        <label>Tour:</label>
        <select name="tuor_id" id="tourSelect" required>
          <option value="">-- Chọn tour --</option>
          <?php foreach ($listTour as $item) : ?>
            <option value="<?= $item['id'] ?>" data-thoigian="<?= ($item['phienban_thoigian'] ?? '') ?>" data-phuongtien="<?= ($item['phienban_phuongtien']) ?>"><?= ($item['name']) ?> (<?= ($item['danhmuc_name']) ?>)</option>
          <?php endforeach ; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Số Người:</label>
        <input type="number" name="soluong_nguoi" min="1" required>
      </div>

      <div class="form-group">
        <label>Giới Tính:</label>
        <select name="gioitinh">
          <option value="">-- Chọn giới tính --</option>
          <option value="nam">Nam</option>
          <option value="nữ">Nữ</option>
          <option value="khác">Khác</option>
        </select>
      </div>

       <div class="form-group">
          <label>Ngày khởi hành (dự kiến)</label>
          <input type="date" name="ngaykhoi_hanh">
        </div>

      <div class="form-group">
        <label>Số ngày:</label>
        <input type="text" id="songay" placeholder="Số ngày sẽ đi Vd: 3 ngày 2 đêm" name="songay">
      </div>

      <div class="form-group">
        <label>Phương tiện di chuyển:</label>
        <input type="text" id="phuongtien" placeholder="VD: Máy bay, Ô tô" name="phuongtien">
      </div>

       <div class="form-group">
        <label>Danh sách khách hàng:</label>
        <textarea name="danhsachkhachhang" placeholder="Danh sách những người đi tour (Nếu có)" rows="3"></textarea>
      </div>
            
      <div class="form-group">
        <label>Yêu Cầu Đặc Biệt:</label>
        <textarea name="yeucaudacbiet" placeholder="Các bệnh lí, dị ứng, v.v" rows="3"></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-save">Lưu</button>
        <a class="btn-cancel" href="?action=manageBookings">Hủy</a>
      </div>

    </form>
  </div>
</div>

<script>
document.getElementById('tourSelect').addEventListener('change', function() {
  const selectedOption = this.options[this.selectedIndex];
  const thoigian = selectedOption.getAttribute('data-thoigian');
  const phuongtien = selectedOption.getAttribute('data-phuongtien')
  document.getElementById('songay').value = thoigian || '';
  document.getElementById('phuongtien').value = phuongtien || '';
});
</script>

<?php require_once "views/admin/layout/footer.php"; ?>
