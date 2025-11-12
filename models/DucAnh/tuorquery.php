<?php
class tuorquery extends BaseModel{
    public function all(){
        try{
          $sql = "SELECT * FROM `tuor`";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $tuor = new tuor();
            $tuor->id = $a["id"];
            $tuor->name = $a["name"];
            $tuor->danhmuc_id = $a["danhmuc_id"];
            $tuor->mota = $a["mota"];
            $tuor->phienban_id = $a["phienban_id"];
            $arr[]=$tuor;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $tuor = new tuor();
            $tuor->id = $data["id"];
            $tuor->name = $data["name"];
            $tuor->danhmuc_id = $data["danhmuc_id"];
            $tuor->mota = $data["mota"];
            $tuor->phienban_id = $data["phienban_id"];
           return $tuor;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function create(tuor $tuor){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(tuor $tuor){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
}
?>