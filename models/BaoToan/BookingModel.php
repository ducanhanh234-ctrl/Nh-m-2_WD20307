<?php 

class BookingModel extends BaseModel {
    public function GetAllBooking() {
        //! ⚠️ QUAN TRỌNG: Chiến lược 2 query để đảm bảo tương thích với HDV
        //? Query 1: CÓ JOIN HDV (yêu cầu cột booking.hdv_id phải tồn tại trong DB)
        $sqlWithHdv = "
            SELECT 
                b.*,
                t.name AS tour_name,
                p.phuongtien AS phienban_phuongtien,
                ncc.ten_don_vi AS nhacungcap_name,
                h.name AS hdv_name,
                s.name AS status_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id
            LEFT JOIN phienban p ON t.phienban_id = p.id
            LEFT JOIN nha_cung_cap ncc ON p.nhacungcap_id = ncc.id
            LEFT JOIN nhansu h ON b.hdv_id = h.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            ORDER BY b.id DESC
        ";

        //? Query 2: KHÔNG JOIN HDV (sử dụng khi cột booking.hdv_id chưa tồn tại)
        $sqlWithoutHdv = "
            SELECT 
                b.*,
                t.name AS tour_name,
                p.phuongtien AS phienban_phuongtien,
                ncc.ten_don_vi AS nhacungcap_name,
                s.name AS status_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id
            LEFT JOIN phienban p ON t.phienban_id = p.id
            LEFT JOIN nha_cung_cap ncc ON p.nhacungcap_id = ncc.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            ORDER BY b.id DESC
        ";

        //! CHÍNH: Thử query CÓ JOIN HDV trước (trả về hdv_name)
        try {
            $stmt = $this->pdo->prepare($sqlWithHdv);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            //? DỰ PHÒNG 1: Nếu JOIN HDV thất bại (vì cột không tồn tại), dùng query an toàn
            //! Điều này ngăn chặn lỗi fatal khi booking.hdv_id chưa được thêm vào DB
            try {
                $stmt = $this->pdo->prepare($sqlWithoutHdv);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (\PDOException $e2) {
                //! DỰ PHÒNG 2: Cách cuối cùng - trả về mảng rỗng để tránh crash
                return [];
            }
        }
    }
    

    public function deleteBooking($id) {
        $sql = "DELETE FROM booking WHERE `booking`.`id` = :id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
    }

    public function addNewBooking($tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet) {
    $sql = "INSERT INTO `booking`
            (`tenkhach`, `soluong_nguoi`, `tuor_id`, `sdt`, `gioitinh`, `cccd`, `songay`, `yeucaudacbiet`, `email`, `trangthai_booking`, `ngaykhoi_hanh`)
            VALUES
            (:tenkhach, :soluong_nguoi, :tuor_id, :sdt, :gioitinh, :cccd, :songay, :yeucaudacbiet, :email, 1, :ngaykhoi_hanh)";
    
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

    return $stmt->execute();
}

    public function GetBookingId($id) {
        $sql = 'SELECT * FROM `booking` WHERE `id` = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }   

    public function editNewBooking($id, $tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet) {
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
                    `ngaykhoi_hanh` = :ngaykhoi_hanh 
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
        try {
            $sql = "UPDATE `booking` SET `hdv_id` = :hdv WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':hdv' => $hdvId, ':id' => $bookingId]);
        } catch (\PDOException $e) {
            // Nếu cột hdv_id không tồn tại hoặc lỗi khác, trả về false
            return false;
        }
    }

}