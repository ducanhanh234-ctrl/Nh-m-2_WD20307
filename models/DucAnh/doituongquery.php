<?php
class doituongquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `doituong_price`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $doituong = new doituong();
            $doituong->id = $a["id"];
            $doituong->loai_doituong = $a["loai_doituong"];
            $doituong->giam = $a["giam"];
            $arr[]=$doituong;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>