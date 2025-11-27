<?php
class lichtrinhcontro {
    public $lichtrinhquery;
    public $tuorquery;
    public function __construct(){
        $this->lichtrinhquery = new lichtrinhquery();
        $this->tuorquery = new tuorquery();
    }
    public function lichtrinh_list(){
        $arr = $this->lichtrinhquery->all();
        include "views/admin/lichtrinh/list.php";
    }
    public function lichtrinh_insert(){
        $arr_tuor = $this->tuorquery->all();
        $lichtrinh = new lichtrinh();
        if(isset($_POST["nut"])){
            $lichtrinh->tuor_id = trim($_POST["tuor_id"]);
            $lichtrinh->ngay = trim($_POST["ngay"]);
            $lichtrinh->diadiem = trim($_POST["diadiem"]);
            $lichtrinh->hoatdongcuthe = trim($_POST["hoatdongcuthe"]);
            $data = $this->lichtrinhquery->insert($lichtrinh);
            if($data == 1){
                header("Location: ?action=lichtrinh-list");
            }
        }
        include "views/admin/lichtrinh/insert.php";
    }
    public function lichtrinh_update($id){
        $arr_find = $this->lichtrinhquery->find($id);
        $arr_tuor = $this->tuorquery->all();
        $lichtrinh = new lichtrinh();
        $lichtrinh->id = $id;
        if(isset($_POST["nut"])){
            $lichtrinh->tuor_id = trim($_POST["tuor_id"]);
            $lichtrinh->ngay = trim($_POST["ngay"]);
            $lichtrinh->diadiem = trim($_POST["diadiem"]);
            $lichtrinh->hoatdongcuthe = trim($_POST["hoatdongcuthe"]);
            $data = $this->lichtrinhquery->update($lichtrinh);
            if($data == 1){
                header("Location: ?action=lichtrinh-list");
            }else{
                header("Location: ?action=lichtrinh-list");
            }
        }
        include "views/admin/lichtrinh/update.php";
    }
    public function lichtrinh_delete($id){
        $data = $this->lichtrinhquery->delete($id);
        if($data == 1){
            header("Location: ?action=lichtrinh-list");
        }else{
            echo "lỗi";
        }
    }
}