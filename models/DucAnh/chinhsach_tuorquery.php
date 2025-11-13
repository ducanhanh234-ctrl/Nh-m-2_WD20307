<?php
class chinhsach_tuorquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT * FROM `chinhsach_tuor`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $chinhsach_tuor = new chinhsach_tuor();
            $chinhsach_tuor->id = $a["id"];
            $chinhsach_tuor->name = $a["name"];
            $arr[]=$chinhsach_tuor;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>