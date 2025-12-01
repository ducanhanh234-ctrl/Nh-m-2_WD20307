<?php
class tuorquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT tuor.* , 
danhmuc_tuor.name as danhmuc_name , 
phienban.name as phienban_name , 
phienban.price as phienban_price , 
phienban.thoigian as phienban_thoigian ,  
phienban.khoihanh as phienban_khoihanh
FROM tuor
JOIN danhmuc_tuor ON tuor.danhmuc_id = danhmuc_tuor.id 
JOIN phienban ON tuor.phienban_id = phienban.id";
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
            $tuor->phienban_khoihanh = $a["phienban_khoihanh"];
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
           return $tuor;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(tuor $tuor){
        try{
         $sql = "INSERT INTO `tuor`( `name`, `danhmuc_id`, `mota`, `phienban_id`) VALUES ('".$tuor->name."','".$tuor->danhmuc_id."','".$tuor->mota."','".$tuor->phienban_id."')";
         $data = $this->pdo->exec($sql);
         return $this->pdo->lastInsertId();
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(tuor $tuor){
        try{
         $sql = "UPDATE `tuor` SET `name`='".$tuor->name."',`danhmuc_id`='".$tuor->danhmuc_id."',`mota`='".$tuor->mota."',`phienban_id`='".$tuor->phienban_id."' WHERE `id`='".$tuor->id."'";
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
