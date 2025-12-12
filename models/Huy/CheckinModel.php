<?php
class CheckinModel extends BaseModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. LẤY DANH SÁCH TOUR CỦA HDV
  public function getToursByHDV($hdv_id) {
    $sql = "
        SELECT 
            t.id,
            t.name AS tentour,
            COALESCE(
                DATE_FORMAT(MIN(b.ngaykhoi_hanh), '%d/%m/%Y'),
                'Chưa có lịch'
            ) AS ngaykhoi_hanh
        FROM tuor t
        LEFT JOIN booking b ON t.id = b.tuor_id AND b.ngaykhoi_hanh IS NOT NULL
        GROUP BY t.id, t.name
        ORDER BY t.id ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // 2. LẤY DANH SÁCH KHÁCH TRONG TOUR + TRẠNG THÁI CHECKIN (THEO LỊCH TRÌNH)
    public function getKhachByTourAndDiem($tuor_id, $lichtrinh_id) {
        $sql = "SELECT 
                    bc.id AS khach_id,
                    bc.hovaten AS hoten,
                    bc.cccd,
                    bc.sdt,
                    c.trangthai_check,
                    c.lichtrinh_id,
                    c.ghichu,
                    lt.diadiem
                FROM bookingchitiet bc
                JOIN booking b ON bc.booking_id = b.id
                LEFT JOIN checkin c ON bc.id = c.bookingct_id 
                    AND c.lichtrinh_id = ?
                LEFT JOIN lichtrinh lt ON c.lichtrinh_id = lt.id
                WHERE b.tuor_id = ? 
                ORDER BY bc.hovaten";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$lichtrinh_id, $tuor_id]);
        return $stmt;
    }

    // 3. LƯU CHECKIN (THEO LỊCH TRÌNH)
    public function updateCheckin($tuor_id, $khach_id, $lichtrinh_id, $trangthai_check, $ghichu = '') {
        // Kiểm tra xem đã có bản ghi checkin cho khách này tại lịch trình này chưa
        $sqlCheck = "SELECT id FROM checkin WHERE bookingct_id = ? AND lichtrinh_id = ? LIMIT 1";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([$khach_id, $lichtrinh_id]);
        $rowCheck = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($rowCheck) {
            // ĐÃ CÓ -> CẬP NHẬT LẠI TRẠNG THÁI & GHI CHÚ CHO ĐÚNG NGƯỜI ĐÓ
            $sqlUpdate = "UPDATE checkin
                          SET trangthai_check = ?,
                              ghichu = ?
                          WHERE id = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            return $stmtUpdate->execute([$trangthai_check, $ghichu, $rowCheck['id']]);
        } else {
            // CHƯA CÓ -> THÊM MỚI BẢN GHI CHECKIN CHO KHÁCH NÀY
            $sqlInsert = "INSERT INTO checkin
                          (bookingct_id, lichtrinh_id, trangthai_check, ghichu)
                          VALUES (?, ?, ?, ?)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            return $stmtInsert->execute([$khach_id, $lichtrinh_id, $trangthai_check, $ghichu]);
        }
    }

  // LẤY DANH SÁCH CÁC CHẶNG CỦA TOUR TỪ BẢNG LỊCH TRÌNH (KHÔNG DỰA TRÊN CHECKIN)
public function getDiemDaCheck($tuor_id) {
    $sql = "SELECT id AS lichtrinh_id, diadiem
            FROM lichtrinh
            WHERE tuor_id = ?
            ORDER BY ngay, gio, id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$tuor_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>