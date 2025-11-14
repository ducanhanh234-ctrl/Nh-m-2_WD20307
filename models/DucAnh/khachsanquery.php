<?php
class khachsanquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT khachsan.*, trangthai_phongks.name as trangthai_phongks_name
FROM khachsan
JOIN trangthai_phongks ON khachsan.trangthai_phongks_id = trangthai_phongks.id ";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $khachsan = new khachsan();
            $khachsan->id = $a["id"];
            $khachsan->ten_ks = $a["ten_ks"];
            $khachsan->ten_phong = $a["ten_phong"];
            $khachsan->so_giuong = $a["so_giuong"];
            $khachsan->trangthai_phongks_id = $a["trangthai_phongks_id"];
            $khachsan->trangthai_phongks_name = $a["trangthai_phongks_name"];
            $arr[]=$khachsan;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>