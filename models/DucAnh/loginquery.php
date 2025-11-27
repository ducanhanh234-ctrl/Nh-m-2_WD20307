<?php
class loginquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT login.* , nhansu.name as nhansu_name , nhansu.ngaysinh as nhansu_ngaysinh , nhansu.sdt as nhansu_sdt , nhansu.email as nhansu_email FROM login JOIN nhansu ON login.nhansu_id = nhansu.id;";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $login = new login();
            $login->id = $a["id"];
            $login->nhansu_id = $a["nhansu_id"];
            $login->role = $a["role"];
            $login->tentk = $a["tentk"];
            $login->mk = $a["mk"];
            $login->nhansu_name = $a["nhansu_name"];
            $login->nhansu_ngaysinh = $a["nhansu_ngaysinh"];
            $login->nhansu_sdt = $a["nhansu_sdt"];
            $login->nhansu_email = $a["nhansu_email"];
            $arr[]=$login;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
    public function find($id){
        try{
          $sql = "SELECT * FROM `login` WHERE `id` = $id";
        $data = $this->pdo->query($sql)->fetch();
        if($data === false){
            echo "lỗi<br>";
        }else{

            $login = new login();
             $login->id = $data["id"];
            $login->nhansu_id = $data["nhansu_id"];
            $login->role = $data["role"];
            $login->tentk = $data["tentk"];
            $login->mk = $data["mk"];
           return $login;
        }
        
        
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function insert(login $login){
        try{
         $sql = "INSERT INTO `login`( `nhansu_id`,  `tentk`, `mk`) VALUES (
         '".$login->nhansu_id."','".$login->tentk."',
         '".$login->mk."')";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function update(login $login){
        try{
         $sql = "UPDATE `login` SET `role`='".$login->role."'
          WHERE `id`='".$login->id."'";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }
    public function delete($id){
        try{
         $sql = "DELETE FROM login WHERE `login`.`id` = $id";
         $data = $this->pdo->exec($sql);
         return $data;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
    }

}
?>