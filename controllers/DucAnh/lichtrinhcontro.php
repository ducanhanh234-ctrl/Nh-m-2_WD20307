<?php
class lichtrinhcontro {
    public $lichtrinhquery;
    public $tuorquery;
    public $kehoachkhquery;
    
    public function __construct(){
        $this->lichtrinhquery = new lichtrinhquery();
        $this->tuorquery = new tuorquery();
        $this->kehoachkhquery = new kehoachkhquery();
    }
    public function lichtrinh_list(){
        $arr = $this->lichtrinhquery->all();
        include "views/admin/lichtrinh/list.php";
    }
    public function lichtrinh_insert(){
        $arr_tuor = $this->tuorquery->all();
        $lichtrinh = new lichtrinh();
        $so_ngay = $_SESSION["songay"];
        $tuor_id = $_SESSION["tuor_id"];
       
        if(isset($_POST["nut"])){
            $lichtrinh->tuor_id = trim($_POST["tuor_id"]);
            $lichtrinh->diadiem = trim($_POST["diadiem"]);
            $lichtrinh->hoatdongcuthe = trim($_POST["hoatdongcuthe"]);
            $lichtrinh->gio = trim($_POST["gio"]);
             $lichtrinh->ngay = trim($_POST["ngay"]);
            $data = $this->lichtrinhquery->insert($lichtrinh);
            if($data == 1){
            header("Location: ?action=lichtrinh-insert&tuor_id=$tuor_id");
            exit();
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
            $lichtrinh->gio = trim($_POST["gio"]);
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
        $arr_kehoach = $this->kehoachkhquery->find($id);
        if($arr_kehoach && $arr_kehoach->lichtrinh_id == $id){
         echo "<script>
            alert('Không Xóa Đc Tuor Này Vì trong kế hoạch khởi hành đã chọn ');
            window.location.href='?action=lichtrinh-list'; 
            </script>";
        }
        $data = $this->lichtrinhquery->delete($id);
        if($data == 1){
            header("Location: ?action=lichtrinh-list");
        }else{
            echo "lỗi";
        }
    }
}