<?php
class phienbanquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT * FROM `phienban`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $phienban = new phienban();
            $phienban->id = $a["id"];
            $phienban->name = $a["name"];
            $phienban->loaipb_id = $a["loaipb_id"];
            $phienban->anh_tuor_id = $a["anh_tuor_id"];
            $phienban->chinhsach_tuor_id = $a["chinhsach_tuor_id"];
            $phienban->nhacungcap_id = $a["nhacungcap_id"];
            $phienban->price = $a["price"];
            $phienban->thoigian = $a["thoigian"];
            $phienban->phuongtien = $a["phuongtien"];
            $phienban->khoihanh = $a["khoihanh"];
            $phienban->khachsan_id = $a["khachsan_id"];
            $arr[]=$phienban;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "";
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
    public function create(phienban $phienban){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(phienban $phienban){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}
?>