<?php
class anh_tuorquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `anh_tuor`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $anh_tuor = new anh_tuor();
            $anh_tuor->id = $a["id"];
            $anh_tuor->img_main = $a["img_main"];
            $anh_tuor->img_phu_1 = $a["img_phu_1"];
            $anh_tuor->img_phu_2 = $a["img_phu_2"];
            $anh_tuor->img_phu_3 = $a["img_phu_3"];
            $arr[]=$anh_tuor;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>