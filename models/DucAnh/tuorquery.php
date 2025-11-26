<?php
class tuorquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT tuor.* , 
danhmuc_tuor.name as danhmuc_name , 
phienban.name as phienban_name , 
phienban.price as phienban_price , 
phienban.thoigian as phienban_thoigian , 
phienban.phuongtien as phienban_phuongtien , 
phienban.khoihanh as phienban_khoihanh ,
nha_cung_cap.ten_don_vi as nhacungcap_name
FROM tuor
JOIN danhmuc_tuor ON tuor.danhmuc_id = danhmuc_tuor.id 
JOIN phienban ON tuor.phienban_id = phienban.id
JOIN nha_cung_cap ON tuor.nhacungcap_id = nha_cung_cap.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $tuor = new tuor();
            $tuor->id = $a["id"];
            $tuor->name = $a["name"];
            $tuor->danhmuc_id = $a["danhmuc_id"];
            $tuor->danhmuc_name = $a["danhmuc_name"];
            $tuor->mota = $a["mota"];
            $tuor->phienban_id = $a["phienban_id"];
            $tuor->phienban_name = $a["phienban_name"];
            $tuor->phienban_price = $a["phienban_price"];
            $tuor->phienban_thoigian = $a["phienban_thoigian"];
            $tuor->phienban_phuongtien = $a["phienban_phuongtien"];
            $tuor->phienban_khoihanh = $a["phienban_khoihanh"];
            $tuor->nhacungcap_id = $a["nhacungcap_id"];
            $tuor->nhacungcap_name = $a["nhacungcap_name"];
            $arr[]=$tuor;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `tuor` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $tuor = new tuor();
            $tuor->id = $data["id"];
            $tuor->name = $data["name"];
            $tuor->danhmuc_id = $data["danhmuc_id"];
            $tuor->mota = $data["mota"];
            $tuor->phienban_id = $data["phienban_id"];
            $tuor->nhacungcap_id = $data["nhacungcap_id"];
           return $tuor;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(tuor $tuor){
        try{
         $sql = "INSERT INTO `tuor`( `name`, `danhmuc_id`, `mota`, `phienban_id`, `nhacungcap_id`) VALUES ('".$tuor->name."','".$tuor->danhmuc_id."','".$tuor->mota."','".$tuor->phienban_id."','".$tuor->nhacungcap_id."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(tuor $tuor){
        try{
         $sql = "UPDATE `tuor` SET `name`='".$tuor->name."',`danhmuc_id`='".$tuor->danhmuc_id."',`mota`='".$tuor->mota."',`phienban_id`='".$tuor->phienban_id."',`nhacungcap_id`='".$tuor->nhacungcap_id."' WHERE `id`='".$tuor->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM tuor WHERE `tuor`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
}
    }
}
?>
