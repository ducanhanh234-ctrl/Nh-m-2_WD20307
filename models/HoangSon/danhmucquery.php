<?php
class danhmucquery extends BaseModel{
    public function all(){
        try{
         $sql = "SELECT * FROM `danhmuc_tuor`";
         $data = $this->pdo->query($sql)->fetchAll();
         $arr = [];
         foreach($data as $a){
            $danhmuc = new danhmuc();
            $danhmuc->id = $a["id"];
            $danhmuc->name = $a["name"];
            $arr[]=$danhmuc;
           
         }
          return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function find($id){
        try{
         $sql = "SELECT * FROM `danhmuc_tuor` WHERE `id` = $id";
         $data = $this->pdo->query($sql)->fetch();
         if($data === false){
            echo "lỗi<br>";
        }else{

            $danhmuc = new danhmuc();
            $danhmuc->id = $data["id"];
            $danhmuc->name = $data["name"];
           return $danhmuc;
        }
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(danhmuc $danhmuc){
        try{
         $sql = "INSERT INTO `danhmuc_tuor`(`name`) VALUES ('".$danhmuc->name."')";
         $data = $this->pdo->exec($sql);
          return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(danhmuc $danhmuc){
        try{
         $sql = "UPDATE `danhmuc_tuor` SET `name`='".$danhmuc->name."' WHERE `id`='".$danhmuc->id."'";
         $data = $this->pdo->exec($sql);
          return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM danhmuc_tuor WHERE `danhmuc_tuor`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}