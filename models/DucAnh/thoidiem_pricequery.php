<?php
class thoidiem_pricequery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `thoidiem_price`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $thoidiem_price = new thoidiem_price();
            $thoidiem_price->id = $a["id"];
            $thoidiem_price->loai_thoidiem = $a["loai_thoidiem"];
            $thoidiem_price->giam = $a["giam"];
            $thoidiem_price->tang = $a["tang"];
            $arr[]=$thoidiem_price;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>