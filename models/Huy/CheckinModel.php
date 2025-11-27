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
    public function updateCheckin($khach_id, $diem_taptrung, $trangthai_check, $ghichu = '') {
        $sql = "INSERT INTO checkin 
                (bookingct_id, diem_taptrung, trangthai_check, ghichu) 
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    trangthai_check = VALUES(trangthai_check),
                    ghichu = VALUES(ghichu)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$khach_id, $diem_taptrung, $trangthai_check, $ghichu]);
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