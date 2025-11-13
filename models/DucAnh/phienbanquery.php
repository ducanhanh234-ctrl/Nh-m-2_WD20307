<?php
class phienbanquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT pb.*, loaipb.name as loaipb_name , anh_tuor.img_main as anh_tuor_name, chinhsach_tuor.name as chinhsach_tuor_name ,
nha_cung_cap.ten_don_vi as nhacungcap_name, khachsan.ten_ks as khachsan_name FROM phienban as pb
JOIN loai_phienban_tuor as loaipb ON pb.loaipb_id = loaipb.id
JOIN anh_tuor ON pb.anh_tuor_id = anh_tuor.id
JOIN chinhsach_tuor ON pb.chinhsach_tuor_id = chinhsach_tuor.id
JOIN nha_cung_cap ON pb.nhacungcap_id = nha_cung_cap.id
JOIN khachsan ON pb.khachsan_id = khachsan.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $phienban = new phienban();
            $phienban->id = $a["id"];
            $phienban->name = $a["name"];
            $phienban->loaipb_id = $a["loaipb_id"];
            $phienban->loaipb_name = $a["loaipb_name"];
            $phienban->anh_tuor_id = $a["anh_tuor_id"];
            $phienban->anh_tuor_name = $a["anh_tuor_name"];
            $phienban->chinhsach_tuor_id = $a["chinhsach_tuor_id"];
            $phienban->chinhsach_tuor_name = $a["chinhsach_tuor_name"];
            $phienban->nhacungcap_id = $a["nhacungcap_id"];
            $phienban->nhacungcap_name = $a["nhacungcap_name"];
            $phienban->price = $a["price"];
            $phienban->thoigian = $a["thoigian"];
            $phienban->phuongtien = $a["phuongtien"];
            $phienban->khoihanh = $a["khoihanh"];
            $phienban->khachsan_id = $a["khachsan_id"];
            $phienban->khachsan_name = $a["khachsan_name"];
            $arr[]=$phienban;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `phienban` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $phienban = new phienban();
            $phienban->id = $data["id"];
            $phienban->name = $data["name"];
            $phienban->loaipb_id = $data["loaipb_id"];
            $phienban->anh_tuor_id = $data["anh_tuor_id"];
            $phienban->chinhsach_tuor_id = $data["chinhsach_tuor_id"];
            $phienban->nhacungcap_id = $data["nhacungcap_id"];
            $phienban->price = $data["price"];
            $phienban->thoigian = $data["thoigian"];
            $phienban->phuongtien = $data["phuongtien"];
            $phienban->khoihanh = $data["khoihanh"];
            $phienban->khachsan_id = $data["khachsan_id"];
           return $phienban;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(phienban $phienban){
        try{
         $sql = "INSERT INTO `phienban`( `name`, `loaipb_id`, `anh_tuor_id`, `chinhsach_tuor_id`, `nhacungcap_id`, `price`, `thoigian`, `phuongtien`, `khoihanh`, `khachsan_id`) VALUES 
         ('".$phienban->name."','".$phienban->loaipb_id."','".$phienban->anh_tuor_id."','".$phienban->chinhsach_tuor_id."','".$phienban->nhacungcap_id."','".$phienban->price."','".$phienban->thoigian."','".$phienban->phuongtien."','".$phienban->khoihanh."','".$phienban->khachsan_id."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(phienban $phienban){
        try{
         $sql = "UPDATE `phienban` SET `name`='".$phienban->name."',
         `loaipb_id`='".$phienban->loaipb_id."',`anh_tuor_id`='".$phienban->anh_tuor_id."',`chinhsach_tuor_id`='".$phienban->chinhsach_tuor_id."'
         ,`nhacungcap_id`='".$phienban->nhacungcap_id."',`price`='".$phienban->price."',`thoigian`='".$phienban->thoigian."',
         `phuongtien`='".$phienban->phuongtien."',`khoihanh`='".$phienban->khoihanh."',`khachsan_id`='".$phienban->khachsan_id."' WHERE `id`='".$phienban->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM phienban WHERE `phienban`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}
?>