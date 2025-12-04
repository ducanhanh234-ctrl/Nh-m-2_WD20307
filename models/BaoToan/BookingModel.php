<?php 

class BookingModel extends BaseModel {
    public function GetAllBooking() {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,

                pt.name AS phuongtien_name,

                

                h.name AS hdv_name,
                s.name AS status_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id

            LEFT JOIN phuongtien pt ON b.phuongtien_id = pt.id

            LEFT JOIN nhansu h ON b.hdv_id = h.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            ORDER BY b.id DESC
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy chi tiết một booking (dùng cho trang xemChiTietBooking)
    public function GetBookingDetail($id) {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,
                pt.name AS phuongtien_name,
                ncc_pt.ten_don_vi AS nhacungcap_phuongtien_name,
                ks.ten_ks AS khachsan_name,
                ncc_ks.ten_don_vi AS nhacungcap_khachsan_name,
                h.name AS hdv_name,
                s.name AS status_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id
            LEFT JOIN phuongtien pt ON b.phuongtien_id = pt.id
            LEFT JOIN nha_cung_cap ncc_pt ON pt.nhacungcap_id = ncc_pt.id
            LEFT JOIN khachsan ks ON b.khachsan_id = ks.id
            LEFT JOIN nha_cung_cap ncc_ks ON ks.nhacungcap_id = ncc_ks.id
            LEFT JOIN nhansu h ON b.hdv_id = h.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            WHERE b.id = :id
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function GetDanhSachKhach($id) {
        $sql = "SELECT * FROM bookingchitiet WHERE booking_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy danh sách phương tiện kèm nhà cung cấp
    public function getAllPhuongTienWithNcc() {
        $sql = "
            SELECT 
                pt.*,
                ncc.ten_don_vi,
                ncc.diachi,
                ncc.lienhe,
                ncc.nang_luc_cung_cap
            FROM phuongtien pt
            LEFT JOIN nha_cung_cap ncc ON pt.nhacungcap_id = ncc.id
            ORDER BY pt.id ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPhuongTienById($id) {
        $sql = "
            SELECT 
                pt.*,
                ncc.ten_don_vi,
                ncc.diachi,
                ncc.lienhe,
                ncc.nang_luc_cung_cap
            FROM phuongtien pt
            LEFT JOIN nha_cung_cap ncc ON pt.nhacungcap_id = ncc.id
            WHERE pt.id = :id
            LIMIT 1
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Lấy danh sách khách sạn kèm nhà cung cấp
    public function getAllKhachSanWithNcc() {
        $sql = "
            SELECT 
                ks.*,
                ncc.ten_don_vi,
                ncc.diachi,
                ncc.lienhe,
                ncc.nang_luc_cung_cap
            FROM khachsan ks
            LEFT JOIN nha_cung_cap ncc ON ks.nhacungcap_id = ncc.id
            ORDER BY ks.id ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getKhachSanById($id) {
        $sql = "
            SELECT 
                ks.*,
                ncc.ten_don_vi,
                ncc.diachi,
                ncc.lienhe,
                ncc.nang_luc_cung_cap
            FROM khachsan ks
            LEFT JOIN nha_cung_cap ncc ON ks.nhacungcap_id = ncc.id
            WHERE ks.id = :id
            LIMIT 1
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteBooking($id) {
        // Kiểm tra xem booking đã có thanh toán chưa
        $sqlCheckThanhtoan = "SELECT COUNT(*) FROM thanhtoan WHERE booking_id = :id";
        $stmtCheck = $this->pdo->prepare($sqlCheckThanhtoan);
        $stmtCheck->bindParam(':id', $id);
        $stmtCheck->execute();
        $countThanhtoan = $stmtCheck->fetchColumn();
        
        // Nếu đã có thanh toán thì không cho phép xóa
        if ($countThanhtoan > 0) {
            return false;
        }
        
        // Lấy danh sách bookingchitiet_id của booking này
        $sqlGetBookingChiTiet = "SELECT id FROM bookingchitiet WHERE booking_id = :id";
        $stmtGet = $this->pdo->prepare($sqlGetBookingChiTiet);
        $stmtGet->bindParam(':id', $id);
        $stmtGet->execute();
        $bookingChiTietIds = $stmtGet->fetchAll(PDO::FETCH_COLUMN);
        
        // Xóa các checkin liên quan (nếu có)
        if (!empty($bookingChiTietIds)) {
            $placeholders = implode(',', array_fill(0, count($bookingChiTietIds), '?'));
            $sqlCheckin = "DELETE FROM checkin WHERE bookingct_id IN ($placeholders)";
            $stmtCheckin = $this->pdo->prepare($sqlCheckin);
            $stmtCheckin->execute($bookingChiTietIds);
        }
        
        // Xóa các bookingchitiet liên quan
        $sql1 = "DELETE FROM bookingchitiet WHERE `booking_id` = :id";
        $stmt1 = $this->pdo->prepare($sql1);
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        
        // Sau đó mới xóa booking (cha)
        $sql2 = "DELETE FROM booking WHERE `id` = :id";
        $stmt2 = $this->pdo->prepare($sql2);
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();
        
        return true;
    }

    public function addNewBooking($tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet, $phuongtien_id = null, $khachsan_id = null) {
        // Lấy giá tour từ bảng phienban thông qua tuor
        $price = 0;
        if (!empty($tuor_id)) {
            $sqlPrice = "SELECT pb.price 
                         FROM tuor t 
                         JOIN phienban pb ON t.phienban_id = pb.id 
                         WHERE t.id = :tuor_id 
                         LIMIT 1";
            $stmtPrice = $this->pdo->prepare($sqlPrice);
            $stmtPrice->bindParam(':tuor_id', $tuor_id, PDO::PARAM_INT);
            $stmtPrice->execute();
            $price = (int)($stmtPrice->fetchColumn() ?? 0);
        }

        $soNguoi = (int)$soluong_nguoi;
        $tongTienTour = $price > 0 && $soNguoi > 0 ? $price * $soNguoi : 0;

        $sql = "INSERT INTO `booking`
                (`tenkhach`, `soluong_nguoi`, `tuor_id`, `sdt`, `gioitinh`, `cccd`, `songay`, `yeucaudacbiet`, `email`, `trangthai_booking`, `ngaykhoi_hanh`, `phuongtien_id`, `khachsan_id`, `tong_tien_tour`)
                VALUES
                (:tenkhach, :soluong_nguoi, :tuor_id, :sdt, :gioitinh, :cccd, :songay, :yeucaudacbiet, :email, 1, :ngaykhoi_hanh, :phuongtien_id, :khachsan_id, :tong_tien_tour)";
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tenkhach', $tenkhach);
        $stmt->bindParam(':soluong_nguoi', $soluong_nguoi);
        $stmt->bindParam(':tuor_id', $tuor_id);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':cccd', $cccd);
        $stmt->bindParam(':songay', $songay);
        $stmt->bindParam(':yeucaudacbiet', $yeucaudacbiet);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ngaykhoi_hanh', $ngaykhoi_hanh);
        $stmt->bindParam(':phuongtien_id', $phuongtien_id);
        $stmt->bindParam(':khachsan_id', $khachsan_id);
        $stmt->bindParam(':tong_tien_tour', $tongTienTour, PDO::PARAM_INT);

        $stmt->execute();
        return $this->pdo->lastInsertId();
    }   

    public function addBookingChiTiet($booking_id, $hovaten, $ngaysinh, $gioitinh, $cccd, $sdt) {
        $sql = "INSERT INTO `bookingchitiet`
                (`booking_id`, `hovaten`, `ngaysinh`, `gioitinh`, `cccd`, `sdt`)
                VALUES
                (:booking_id, :hovaten, :ngaysinh, :gioitinh, :cccd, :sdt)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':hovaten', $hovaten);
        $stmt->bindParam(':ngaysinh', $ngaysinh);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':cccd', $cccd);
        $stmt->bindParam(':sdt', $sdt);
        
        return $stmt->execute();
    }

    public function GetBookingId($id) {
        $sql = 'SELECT * FROM `booking` WHERE `id` = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    } 

    public function editNewBooking($id, $tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet, $phuongtien_id = null, $khachsan_id = null) {
        $sql = "UPDATE `booking` 
                SET `tenkhach` = :tenkhach, 
                    `soluong_nguoi` = :soluong_nguoi, 
                    `tuor_id` = :tuor_id, 
                    `sdt` = :sdt, 
                    `gioitinh` = :gioitinh, 
                    `cccd` = :cccd, 
                    `songay` = :songay, 
                    `yeucaudacbiet` = :yeucaudacbiet, 
                    `email` = :email, 
                    `ngaykhoi_hanh` = :ngaykhoi_hanh,
                    `phuongtien_id` = :phuongtien_id,
                    `khachsan_id` = :khachsan_id
                WHERE `booking`.`id` = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tenkhach', $tenkhach);
        $stmt->bindParam(':soluong_nguoi', $soluong_nguoi);
        $stmt->bindParam(':tuor_id', $tuor_id);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':cccd', $cccd);
        $stmt->bindParam(':songay', $songay);
        $stmt->bindParam(':yeucaudacbiet', $yeucaudacbiet);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ngaykhoi_hanh', $ngaykhoi_hanh);
        $stmt->bindParam(':phuongtien_id', $phuongtien_id);
        $stmt->bindParam(':khachsan_id', $khachsan_id);
        
        return $stmt->execute();
    }

    // Cập nhật trạng thái booking
    public function updateStatus($id, $statusId) {
        $sql = "UPDATE `booking` SET `trangthai_booking` = :status WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $statusId, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Gán HDV cho booking (nếu cột hdv_id tồn tại)
    public function assignHdv($bookingId, $hdvId) {
        $sql = "UPDATE `booking` SET `hdv_id` = :hdv WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hdv', $hdvId);
        $stmt->bindParam(':id', $bookingId);
        return $stmt->execute();
    }

    // Lấy danh sách tất cả trạng thái booking
    public function getAllStatuses() {
        $sql = "SELECT * FROM trangthai_booking ORDER BY id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy lịch sử thanh toán của một booking
    public function getPaymentHistory($bookingId) {
        $sql = "SELECT * FROM thanhtoan WHERE booking_id = :booking_id ORDER BY ngay_thanh_toan DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Thêm thanh toán mới
    public function addPayment($bookingId, $soTien, $phuongThuc, $ghiChu = null) {
        $sql = "INSERT INTO thanhtoan (booking_id, so_tien, phuong_thuc, ghi_chu, ngay_thanh_toan) 
                VALUES (:booking_id, :so_tien, :phuong_thuc, :ghi_chu, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
        $stmt->bindParam(':so_tien', $soTien, PDO::PARAM_INT);
        $stmt->bindParam(':phuong_thuc', $phuongThuc);
        $stmt->bindParam(':ghi_chu', $ghiChu);
        
        if ($stmt->execute()) {
            // Cập nhật tổng tiền đã trả trong bảng booking
            $this->updateBookingPayment($bookingId);
            return true;
        }
        return false;
    }

    // Cập nhật tổng tiền đã trả trong booking
    public function updateBookingPayment($bookingId) {
        // Tính tổng tiền đã trả
        $sqlSum = "SELECT COALESCE(SUM(so_tien), 0) as total FROM thanhtoan WHERE booking_id = :booking_id";
        $stmtSum = $this->pdo->prepare($sqlSum);
        $stmtSum->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
        $stmtSum->execute();
        $totalPaid = $stmtSum->fetchColumn();

        // Cập nhật vào bảng booking
        $sqlUpdate = "UPDATE booking SET da_thanh_toan = :da_thanh_toan WHERE id = :booking_id";
        $stmtUpdate = $this->pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':da_thanh_toan', $totalPaid, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
        $stmtUpdate->execute();

        // Tự động cập nhật trạng thái dựa trên thanh toán
        $this->autoUpdateStatusByPayment($bookingId, $totalPaid);
    }

    // Tự động cập nhật trạng thái dựa trên thanh toán
    private function autoUpdateStatusByPayment($bookingId, $totalPaid) {
        // Lấy thông tin booking
        $booking = $this->GetBookingId($bookingId);
        if (!$booking) return;

        $tongTienTour = $booking['tong_tien_tour'] ?? 0;
        $currentStatus = $booking['trangthai_booking'] ?? 1;
        // Nếu đã thanh toán đủ hoặc vượt quá -> trạng thái 3 (Hoàn tất)
        if ($tongTienTour > 0 && $totalPaid >= $tongTienTour && $currentStatus != 3) {
            $this->updateStatus($bookingId, 3);
        }
        // Nếu đã thanh toán một phần và đang ở trạng thái 1 (Chờ thanh toán) -> chuyển sang 2 (Đã đặt cọc)
        elseif ($totalPaid > 0 && $totalPaid < $tongTienTour && $currentStatus == 1) {
            $this->updateStatus($bookingId, 2);
        }
    }
}