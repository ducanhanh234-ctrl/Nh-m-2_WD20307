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

    // 2. LẤY DANH SÁCH KHÁCH TRONG TOUR + TRẠNG THÁI CHECKIN
    public function getKhachByTourAndDiem($tuor_id, $diem_taptrung = 'Sân bay Tân Sơn Nhất') {
        $sql = "SELECT 
                    bc.id AS khach_id,
                    bc.hovaten AS hoten,
                    bc.cccd,
                    bc.sdt,
                    c.trangthai_check,
                    c.diem_taptrung,
                    c.ghichu
                FROM bookingchitiet bc
                JOIN booking b ON bc.booking_id = b.id
                LEFT JOIN checkin c ON bc.id = c.bookingct_id 
                    AND c.diem_taptrung = ?
                WHERE b.tuor_id = ?
                ORDER BY bc.hovaten";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$diem_taptrung, $tuor_id]);
        return $stmt;
    }

    // 3. LƯU CHECKIN
    public function updateCheckin($tuor_id, $khach_id, $diem_taptrung, $trangthai_check, $ghichu = '') {
        // Lấy lichtrinh_id tương ứng với tour và điểm tập trung (nếu có)
        $lichtrinh_id = null;
        $sqlLt = "SELECT k.lichtrinh_id
                  FROM `kẹhoachkhoihanh` k
                  JOIN lichtrinh l ON k.lichtrinh_id = l.id
                  WHERE l.tuor_id = ? AND k.diemtaptrung = ?
                  LIMIT 1";
        $stmtLt = $this->conn->prepare($sqlLt);
        $stmtLt->execute([$tuor_id, $diem_taptrung]);
        $rowLt = $stmtLt->fetch(PDO::FETCH_ASSOC);
        if ($rowLt && isset($rowLt['lichtrinh_id'])) {
            $lichtrinh_id = $rowLt['lichtrinh_id'];
        }

        // Kiểm tra xem đã có bản ghi checkin cho khách này tại điểm tập trung này chưa
        $sqlCheck = "SELECT id FROM checkin WHERE bookingct_id = ? AND diem_taptrung = ? LIMIT 1";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([$khach_id, $diem_taptrung]);
        $rowCheck = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($rowCheck) {
            // ĐÃ CÓ -> CẬP NHẬT LẠI TRẠNG THÁI & GHI CHÚ CHO ĐÚNG NGƯỜI ĐÓ
            $sqlUpdate = "UPDATE checkin
                          SET lichtrinh_id = ?,
                              trangthai_check = ?,
                              ghichu = ?
                          WHERE id = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            return $stmtUpdate->execute([$lichtrinh_id, $trangthai_check, $ghichu, $rowCheck['id']]);
        } else {
            // CHƯA CÓ -> THÊM MỚI BẢN GHI CHECKIN CHO KHÁCH NÀY
            $sqlInsert = "INSERT INTO checkin
                          (bookingct_id, lichtrinh_id, diem_taptrung, trangthai_check, ghichu)
                          VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            return $stmtInsert->execute([$khach_id, $lichtrinh_id, $diem_taptrung, $trangthai_check, $ghichu]);
        }
    }

  // LẤY CÁC CHẶNG ĐÃ ĐIỂM DANH – PHIÊN BẢN CHẠY NGON 100% TRÊN MYSQL 8+
public function getDiemDaCheck($tuor_id) {
    $sql = "SELECT diem_taptrung
            FROM (
                SELECT c.diem_taptrung, c.id
                FROM checkin c
                JOIN bookingchitiet bc ON c.bookingct_id = bc.id
                JOIN booking b ON bc.booking_id = b.id
                WHERE b.tuor_id = ? 
                  AND c.diem_taptrung IS NOT NULL 
                  AND c.diem_taptrung != ''
                ORDER BY c.id DESC
            ) AS sub
            GROUP BY diem_taptrung
            ORDER BY MAX(id) DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$tuor_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
}
?>