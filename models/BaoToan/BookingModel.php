<?php 

class BookingModel extends BaseModel {
    public function GetAllBooking() {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,
                s.name AS status_name
            FROM booking b
            LEFT JOIN tuor t ON b.tuor_id = t.id
            LEFT JOIN trangthai_booking s ON b.trangthai_booking = s.id
            ORDER BY b.id DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
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

}