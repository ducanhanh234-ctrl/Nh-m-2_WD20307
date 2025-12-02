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
        $sql = "INSERT INTO `booking`
                (`tenkhach`, `soluong_nguoi`, `tuor_id`, `sdt`, `gioitinh`, `cccd`, `songay`, `yeucaudacbiet`, `email`, `trangthai_booking`, `ngaykhoi_hanh`, `phuongtien_id`, `khachsan_id`)
                VALUES
                (:tenkhach, :soluong_nguoi, :tuor_id, :sdt, :gioitinh, :cccd, :songay, :yeucaudacbiet, :email, 1, :ngaykhoi_hanh, :phuongtien_id, :khachsan_id)";
        
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
        return $stmt->execute([':status' => $statusId, ':id' => $id]);
    }

    // Gán HDV cho booking (nếu cột hdv_id tồn tại)
    public function assignHdv($bookingId, $hdvId) {
        $sql = "UPDATE `booking` SET `hdv_id` = :hdv WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hdv', $hdvId);
        $stmt->bindParam(':id', $bookingId);
        return $stmt->execute();
    }

}