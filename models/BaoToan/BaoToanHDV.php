<?php
class BaoToanHDV extends BaseModel {
    //? Dùng để HDV xem các tour được phân cho mình
    public function listUserHDV($id) {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,
                ncc.ten_don_vi AS nhacungcap_name,
                s.name AS status_name,
                h.name AS hdv_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id
            LEFT JOIN phienban p ON t.phienban_id = p.id
            LEFT JOIN nha_cung_cap ncc ON p.nhacungcap_id = ncc.id
            LEFT JOIN nhansu h ON b.hdv_id = h.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            WHERE b.hdv_id = :hdv_id
            ORDER BY b.ngaykhoi_hanh DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hdv_id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function nhatKiTour() {
        $sql = 'SELECT nkt.*, t.name AS tour_name, b.tenkhach, b.ngaykhoi_hanh
        FROM nhatky_tuor nkt
        LEFT JOIN booking b ON nkt.booking_id = b.id
        LEFT JOIN tuor t ON b.tuor_id = t.id
        ORDER BY nkt.created_at DESC, nkt.ngay_thu ASC';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
    }

    public function updateXuLy($id, $cach_xu_ly) {
        $sql = 'UPDATE nhatky_tuor 
                SET cach_xu_ly = :cach_xu_ly, updated_at = NOW() 
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cach_xu_ly', $cach_xu_ly);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function addNhatKy($booking_id, $ngay_thu, $image, $su_co, $hoat_dong_noi_bat, $cach_xu_ly) {
        $sql = 'INSERT INTO nhatky_tuor (booking_id, ngay_thu, image, su_co, hoat_dong_noi_bat, cach_xu_ly, created_at, updated_at)
                VALUES (:booking_id, :ngay_thu, :image, :su_co, :hoat_dong_noi_bat, :cach_xu_ly, NOW(), NOW())';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':ngay_thu', $ngay_thu);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':su_co', $su_co);
        $stmt->bindParam(':hoat_dong_noi_bat', $hoat_dong_noi_bat);
        $stmt->bindParam(':cach_xu_ly', $cach_xu_ly);
        return $stmt->execute();
    }
}
?>