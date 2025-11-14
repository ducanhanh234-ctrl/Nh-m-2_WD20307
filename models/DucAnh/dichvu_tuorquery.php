<?php
class dichvu_tuorquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `dichvu_tuor`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $dichvu_tuor = new dichvu_tuor();
            $dichvu_tuor->id = $a["id"];
            $dichvu_tuor->loai_dichvu_tuor = $a["loai_dichvu_tuor"];
            $arr[]=$dichvu_tuor;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>