<?php

class giasaucungquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT gia_saucung.* , doituong_price.loai_doituong as doituong_name , thoidiem_price.loai_thoidiem as thoidiem_name , phienban.name AS phienban_name , dichvukemtheo_price.loai_dichvu AS dvkemtheo_name FROM gia_saucung JOIN doituong_price ON gia_saucung.doituong_id = doituong_price.id JOIN thoidiem_price ON gia_saucung.thoidiem_id = thoidiem_price.id JOIN phienban ON gia_saucung.phienban_id = phienban.id JOIN dichvukemtheo_price ON gia_saucung.dvkemtheo_id = dichvukemtheo_price.id;";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $giasaucung = new giasaucung();
            $giasaucung->id = $a["id"];
            $giasaucung->phienban_id = $a["phienban_id"];
            $giasaucung->phienban_name = $a["phienban_name"];
            $giasaucung->doituong_id = $a["doituong_id"];
            $giasaucung->doituong_name = $a["doituong_name"];
            $giasaucung->thoidiem_id = $a["thoidiem_id"];
            $giasaucung->thoidiem_name = $a["thoidiem_name"];
            $giasaucung->dvkemtheo_id = $a["dvkemtheo_id"];
            $giasaucung->dvkemtheo_name = $a["dvkemtheo_name"];
            $giasaucung->tong_gia = $a["tong_gia"];
            $arr[]=$giasaucung;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `gia_saucung` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $giasaucung = new giasaucung();
            $giasaucung->id = $data["id"];
            $giasaucung->phienban_id = $data["phienban_id"];
            $giasaucung->doituong_id = $data["doituong_id"];
            $giasaucung->thoidiem_id = $data["thoidiem_id"];
            $giasaucung->dvkemtheo_id = $data["dvkemtheo_id"];
            $giasaucung->tong_gia = $data["tong_gia"];
           return $giasaucung;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(giasaucung $giasaucung){
        try{
         $sql = "INSERT INTO `gia_saucung`( `phienban_id`, `thoidiem_id`, `dvkemtheo_id`, `doituong_id`, `tong_gia`) VALUES ('".$giasaucung->phienban_id."','".$giasaucung->thoidiem_id."','".$giasaucung->dvkemtheo_id."','".$giasaucung->doituong_id."','".$giasaucung->tong_gia."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(giasaucung $giasaucung){
        try{
         $sql = "UPDATE `gia_saucung` SET `phienban_id`='".$giasaucung->phienban_id."',`thoidiem_id`='".$giasaucung->thoidiem_id."',`dvkemtheo_id`='".$giasaucung->dvkemtheo_id."'
         ,`doituong_id`='".$giasaucung->doituong_id."',`tong_gia`='".$giasaucung->tong_gia."' WHERE `id`='".$giasaucung->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM gia_saucung WHERE `gia_saucung`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}
?>