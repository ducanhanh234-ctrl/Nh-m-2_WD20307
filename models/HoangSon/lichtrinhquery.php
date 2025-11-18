<?php
class lichtrinhquery extends BaseModel{
    public function all(){
        try{
         $sql = "SELECT * FROM `lichtrinh`";
         $data = $this->pdo->query($sql)->fetchAll();
         $arr = [];
         foreach($data as $a){
            $lichtrinh = new lichtrinh();
            $lichtrinh->id = $a["id"];
            $lichtrinh->tuor_id = $a["tuor_id"];
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
}