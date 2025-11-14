<?php require "header.php"; ?>
<link rel="stylesheet" href="./views/admin/addBooking.css">

<div class="add-booking-container">
  <div class="add-booking-header">
    <a class="phanphong_style_btn" href="?action=manageBookings">← Quay lại</a>
  </div>

  <div class="add-booking-form-wrapper">
    <h3>Sửa Booking</h3>
    
    <form method="POST" action="?action=editNewBooking&id=<?= $getBookingId['id'] ?>" class="booking-form">
      
      <div class="form-group">
        <label>Tên Khách:</label>
        <input type="text" value="<?= $getBookingId['tenkhach'] ?>" name="tenkhach" required>
      </div>

      <div class="form-group">
        <label>SĐT:</label>
        <input type="number" value="<?= $getBookingId['sdt'] ?>" name="sdt" required>
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" value="<?= $getBookingId['email'] ?>" name="email" required>
      </div>

        <div class="form-group">
          <label>CCCD / Số CMND:</label>
          <input type="text" name="cccd" value="<?= $getBookingId['cccd'] ?>" placeholder="0123456789">
        </div>

       

      <div class="form-group">
        <label>Tour:</label>
        <select name="tuor_id" required>
          <option value="">-- Chọn tour --</option>
          <?php foreach ($listTour as $item) : ?>
            <option value="<?= $item['id'] ?>" <?= ($item['id'] == $getBookingId['tuor_id']) ? 'selected' : '' ?>><?= $item['name'] ?></option>
          <?php endforeach ; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Số Người:</label>
        <input type="number" name="soluong_nguoi" value="<?= $getBookingId['soluong_nguoi'] ?>" min="1" required>
      </div>

      <div class="form-group">
        <label>Giới Tính:</label>
        <select name="gioitinh">
          <option value="">-- Chọn giới tính --</option>
          <option value="nam" <?= ($getBookingId['gioitinh'] == 'nam') ? 'selected' : '' ?>>Nam</option>
          <option value="nữ" <?= ($getBookingId['gioitinh'] == 'nữ') ? 'selected' : '' ?>>Nữ</option>
          <option value="khác" <?= ($getBookingId['gioitinh'] == 'khác') ? 'selected' : '' ?>>Khác</option>
        </select>
      </div>

       <div class="form-group">
          <label>Ngày khởi hành (dự kiến)</label>
          <input type="date" value="<?= $getBookingId['ngaykhoi_hanh'] ?>" name="ngaykhoi_hanh">
        </div>

      <div class="form-group">
        <label>Số ngày:</label>
        <input type="text" value="<?= $getBookingId['songay'] ?>" placeholder="Số ngày sẽ đi Vd: 3 ngày 2 đêm" name="songay">
      </div>

      <div class="form-group">
        <label>Yêu Cầu Đặc Biệt:</label>
        <textarea name="yeucaudacbiet" placeholder="Các bệnh lí, dị ứng, v.v" rows="3"><?= htmlspecialchars($getBookingId['yeucaudacbiet'] ?? '') ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-save">Lưu</button>
        <a class="btn-cancel" href="?action=manageBookings">Hủy</a>
      </div>

    </form>
  </div>
</div>

<?php require "footer.php"; ?>

