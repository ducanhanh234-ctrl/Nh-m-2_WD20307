<?php
class HScontroller{
    public $danhmucquery;
    public function __construct(){
        $this->danhmucquery = new danhmucquery();
    }
    public function all_danhmuc(){
        $arr_danhmuc = $this->danhmucquery->all();
        include "views/admin/tuor_danhmuc.php";
    }
    public function insert_danhmuc(){
        $danhmuc = new danhmuc();
        if(isset($_POST["nut"])){
            $danhmuc->name = trim($_POST["name"]);
            $data = $this->danhmucquery->insert($danhmuc);
            if($data == 1){
                header("Location: ?action=tuor_danhmuc");
            }
        }
        include "views/admin/danhmuc_insert.php";
    }
    public function update_danhmuc($id){
        $arr_danhmuc = $this->danhmucquery->find($id);
        $danhmuc = new danhmuc();
        $danhmuc->id = $id;
        if(isset($_POST["nut"])){
            $danhmuc->name = trim($_POST["name"]);
            $data = $this->danhmucquery->update($danhmuc);
            if($data == 1){
                header("Location: ?action=tuor_danhmuc");
            }else{
                header("Location: ?action=tuor_danhmuc");
            }
        }
        include "views/admin/danhmuc_update.php";
    }
    public function delete_danhmuc($id){
       $a = $this->danhmucquery->delete($id);
       if($a == 1){
        header("LOcation: ?action=tuor_danhmuc");
       }else{
        echo "lỗi";
       }
    }
}