<?php
class kehoachkhquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT kẹhoachkhoihanh.*, phienban.name as phienban_name, lichtrinh.ngay as lichtrinh_name, nhansu.name as nhansu_name FROM kẹhoachkhoihanh JOIN phienban ON kẹhoachkhoihanh.phienban_id = phienban.id JOIN lichtrinh ON kẹhoachkhoihanh.lichtrinh_id = lichtrinh.id JOIN nhansu ON kẹhoachkhoihanh.nhansu_id = nhansu.id;";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $kehoachkh = new kehoachkh();
            $kehoachkh->id = $a["id"];
            $kehoachkh->phienban_id = $a["phienban_id"];
            $kehoachkh->phienban_name = $a["phienban_name"];
            $kehoachkh->lichtrinh_id = $a["lichtrinh_id"];
            $kehoachkh->lichtrinh_name = $a["lichtrinh_name"];
            $kehoachkh->nhansu_id = $a["nhansu_id"];
            $kehoachkh->nhansu_name = $a["nhansu_name"];
            $kehoachkh->diemtaptrung = $a["diemtaptrung"];
            $arr[]=$kehoachkh;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `kẹhoachkhoihanh` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $kehoachkh = new kehoachkh();
            $kehoachkh->id = $data["id"];
            $kehoachkh->phienban_id = $data["phienban_id"];
            $kehoachkh->lichtrinh_id = $data["lichtrinh_id"];
            $kehoachkh->nhansu_id = $data["nhansu_id"];
            $kehoachkh->diemtaptrung = $data["diemtaptrung"];
           return $kehoachkh;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(kehoachkh $kehoachkh){
        try{
         $sql = "INSERT INTO `kẹhoachkhoihanh`(`phienban_id`, `lichtrinh_id`, `nhansu_id`, `diemtaptrung`) VALUES ('".$kehoachkh->phienban_id."','".$kehoachkh->lichtrinh_id."','".$kehoachkh->nhansu_id."','".$kehoachkh->diemtaptrung."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(kehoachkh $kehoachkh){
        try{
         $sql = "UPDATE `kẹhoachkhoihanh` SET `phienban_id`='".$kehoachkh->phienban_id."',`lichtrinh_id`='".$kehoachkh->lichtrinh_id."',`nhansu_id`='".$kehoachkh->nhansu_id."',`diemtaptrung`='".$kehoachkh->diemtaptrung."' WHERE `id`='".$kehoachkh->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM kẹhoachkhoihanh WHERE `kẹhoachkhoihanh`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}
?>