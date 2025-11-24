<?php require_once "views/admin/layout/header.php"; ?>
<link rel="stylesheet" href="views/admin/assets/style/BookingCSS/quanlitrangthai.css">
  <div class="booking-section">
            <h3>Quản lý trạng thái Booking</h3>
            <div class="booking-list">
              <table class="booking-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Loại tour</th>
                    <th>Số người</th>
                    <th>Ngày bắt đầu</th>
                    <th>Số ngày</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody id="bookingsList">
                  <?php if (!empty($bookings) && is_array($bookings)): ?>
                    <?php foreach ($bookings as $item): ?>
                      <?php
                        // Map trạng thái id sang class CSS (tùy theo id trong DB)
                        $statusId = $item['trangthai_booking'] ?? null;
                        $statusClass = 'status-pending';
                        switch ($statusId) {
                          case '2': $statusClass = 'status-confirmed'; break;
                          case '3': $statusClass = 'status-processing'; break;
                          case '4': $statusClass = 'status-completed'; break;
                          case '5': $statusClass = 'status-cancelled'; break;
                          default: $statusClass = 'status-pending';
                        }
                      ?>
                      <tr>
                        <td><?= $item['id'] ?? '' ?></td>
                        <td><?= $item['tenkhach'] ?? '' ?></td>
                        <td><?= $item['tour_name'] ?? '' ?></td>
                        <td><?= $item['soluong_nguoi'] ?? '' ?></td>
                        <td><?= $item['ngaykhoi_hanh'] ?? '' ?></td>
                        <td><?= $item['songay'] ?? '' ?> <?= $item['songay'] ? 'ngày' : '' ?></td>
                        <td>
                          <span class="status-badge <?= $statusClass ?>">
                            <?= $item['status_name'] ?? '' ?>
                          </span>
                        </td>
                        <td class="action-buttons">
                          <?php if ($statusId == 1): ?>
                            <a class="btn btn-confirm" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=2"
                               onclick="return confirm('Xác nhận booking này?')">Xác nhận</a>
                            <a class="btn btn-cancel" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=5"
                               onclick="return confirm('Hủy booking này?')">Hủy</a>
                          <?php elseif ($statusId == 2): ?>
                            <a class="btn btn-process" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=3"
                               onclick="return confirm('Bắt đầu xử lý booking này?')">Xử lý</a>
                            <a class="btn btn-cancel" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=5"
                               onclick="return confirm('Hủy booking này?')">Hủy</a>
                          <?php elseif ($statusId == 3): ?>
                            <a class="btn btn-complete" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=4"
                               onclick="return confirm('Xác nhận hoàn tất booking này?')">Hoàn tất</a>
                            <a class="btn btn-cancel" href="index.php?action=changeStatus&id=<?= $item['id'] ?>&status=5"
                               onclick="return confirm('Hủy booking này?')">Hủy</a>
                          <?php else: ?>
                            <span><?= htmlspecialchars($item['status_name'] ?? '') ?></span>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8">Không có booking nào.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
<?php require_once "views/admin/layout/footer.php"; ?>
