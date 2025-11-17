<?php
class nhacungcapquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT nha_cung_cap.* , dichvu_tuor.loai_dichvu_tuor as dichvu_tuor_name 
FROM nha_cung_cap
JOIN dichvu_tuor ON nha_cung_cap.dichvu_tuor_id = dichvu_tuor.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $nhacungcap = new nhacungcap();
            $nhacungcap->id = $a["id"];
            $nhacungcap->ten_don_vi = $a["ten_don_vi"];
            $nhacungcap->diachi = $a["diachi"];
            $nhacungcap->lienhe = $a["lienhe"];
            $nhacungcap->nang_luc_cung_cap = $a["nang_luc_cung_cap"];
            $nhacungcap->dichvu_tuor_id = $a["dichvu_tuor_id"];
            $nhacungcap->dichvu_tuor_name = $a["dichvu_tuor_name"];
            $arr[]=$nhacungcap;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `nha_cung_cap` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $nhacungcap = new nhacungcap();
            $nhacungcap->id = $data["id"];
            $nhacungcap->ten_don_vi = $data["ten_don_vi"];
            $nhacungcap->diachi = $data["diachi"];
            $nhacungcap->lienhe = $data["lienhe"];
            $nhacungcap->nang_luc_cung_cap = $data["nang_luc_cung_cap"];
            $nhacungcap->dichvu_tuor_id = $data["dichvu_tuor_id"];
           return $nhacungcap;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(nhacungcap $nhacungcap){
        try{
         $sql = "INSERT INTO `nha_cung_cap`( `ten_don_vi`, `diachi`, `lienhe`, `nang_luc_cung_cap`, `dichvu_tuor_id`) VALUES 
         ('".$nhacungcap->ten_don_vi."','".$nhacungcap->diachi."','".$nhacungcap->lienhe."','".$nhacungcap->nang_luc_cung_cap."','".$nhacungcap->dichvu_tuor_id."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(nhacungcap $nhacungcap){
        try{
         $sql = "UPDATE `nha_cung_cap` SET `ten_don_vi`='".$nhacungcap->ten_don_vi."',
         `diachi`='".$nhacungcap->diachi."',
         `lienhe`='".$nhacungcap->lienhe."',
         `nang_luc_cung_cap`='".$nhacungcap->nang_luc_cung_cap."',
         `dichvu_tuor_id`='".$nhacungcap->dichvu_tuor_id."' WHERE `id`='".$nhacungcap->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM nha_cung_cap WHERE `nha_cung_cap`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }

}
?>