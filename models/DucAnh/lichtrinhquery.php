<?php
class lichtrinhquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT lichtrinh.* , tuor.name as tuor_name 
FROM lichtrinh 
JOIN tuor ON lichtrinh.tuor_id = tuor.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $lichtrinh = new lichtrinh();
            $lichtrinh->id = $a["id"];
            $lichtrinh->tuor_id = $a["tuor_id"];
            $lichtrinh->tuor_name = $a["tuor_name"];
            $lichtrinh->ngay = $a["ngay"];
            $lichtrinh->diadiem = $a["diadiem"];
            $lichtrinh->hoatdongcuthe = $a["hoatdongcuthe"];
            $arr[]=$lichtrinh;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `lichtrinh` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $lichtrinh = new lichtrinh();
            $lichtrinh->id = $data["id"];
            $lichtrinh->tuor_id = $data["tuor_id"];
            $lichtrinh->ngay = $data["ngay"];
            $lichtrinh->diadiem = $data["diadiem"];
            $lichtrinh->hoatdongcuthe = $data["hoatdongcuthe"];
           return $lichtrinh;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(lichtrinh $lichtrinh){
        try{
         $sql = "INSERT INTO `lichtrinh`(`tuor_id`, `ngay`, `diadiem`, `hoatdongcuthe`) VALUES 
         ('".$lichtrinh->tuor_id."','".$lichtrinh->ngay."','".$lichtrinh->diadiem."','".$lichtrinh->hoatdongcuthe."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(lichtrinh $lichtrinh){
        try{
         $sql = "UPDATE `lichtrinh` SET `tuor_id`='".$lichtrinh->tuor_id."',
         `ngay`='".$lichtrinh->ngay."',
         `diadiem`='".$lichtrinh->diadiem."',
         `hoatdongcuthe`='".$lichtrinh->hoatdongcuthe."' WHERE `id`='".$lichtrinh->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM lichtrinh WHERE `lichtrinh`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }

}
?>