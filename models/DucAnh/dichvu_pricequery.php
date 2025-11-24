<?php
class dichvu_pricequery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `dichvukemtheo_price`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $dichvu_price = new dichvu_price();
            $dichvu_price->id = $a["id"];
            $dichvu_price->loai_dichvu = $a["loai_dichvu"];
            $dichvu_price->giam = $a["giam"];
            $arr[]=$dichvu_price;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>