<?php 

class TourModel extends BaseModel {
    public function GetAllTour() {
        $sql = "SELECT 
                tuor.*, 
                danhmuc_tuor.name as danhmuc_name,
                phienban.name as phienban_name, 
                phienban.price as phienban_price, 
                phienban.thoigian as phienban_thoigian, 
                phienban.khoihanh as phienban_khoihanh 
            FROM tuor 
            JOIN danhmuc_tuor ON tuor.danhmuc_id = danhmuc_tuor.id 
            JOIN phienban ON tuor.phienban_id = phienban.id
            ORDER BY tuor.id DESC";;
         

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetTourId($id) {
        $sql = "SELECT tuor.* , danhmuc_tuor.name as danhmuc_name , phienban.name as phienban_name , phienban.price as phienban_price , phienban.thoigian as phienban_thoigian , phienban.phuongtien as phienban_phuongtien , phienban.khoihanh as phienban_khoihanh FROM tuor JOIN danhmuc_tuor ON tuor.danhmuc_id = danhmuc_tuor.id JOIN phienban ON tuor.phienban_id = phienban.id WHERE tuor.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}