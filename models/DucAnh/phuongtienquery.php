<?php
class phuongtienquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT phuongtien.* , nha_cung_cap.ten_don_vi as nhacungcap_name 
FROM phuongtien
JOIN nha_cung_cap ON phuongtien.nhacungcap_id = nha_cung_cap.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $phuongtien = new phuongtien();
            $phuongtien->id = $a["id"];
            $phuongtien->name = $a["name"];
            $phuongtien->nhacungcap_id = $a["nhacungcap_id"];
            $phuongtien->nhacungcap_name = $a["nhacungcap_name"];
            $arr[]=$phuongtien;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>