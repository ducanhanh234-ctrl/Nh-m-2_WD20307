<?php
class loaipbquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `loai_phienban_tuor`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $loaipb = new loaipb();
            $loaipb->id = $a["id"];
            $loaipb->name = $a["name"];
            $arr[]=$loaipb;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>