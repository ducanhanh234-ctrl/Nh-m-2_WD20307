<?php
class HScontroller{
    public $tuorquery;
    public $danhmucquery;
    public $kehoachkhquery;
    public $phienbanquery;
    public $lichtrinhquery;
    public $UsersQuery;
    public function __construct(){
        $this->danhmucquery = new danhmucquery();
        $this->kehoachkhquery = new kehoachkhquery();
        $this->phienbanquery = new phienbanquery();
        $this->lichtrinhquery = new lichtrinhquery();
        $this->UsersQuery = new UsersQuery();
        $this->tuorquery = new tuorquery();
    }
    public function all_danhmuc(){
        $arr_danhmuc = $this->danhmucquery->all();
        include "views/admin/Tour/tuor_danhmuc.php";
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
        include "views/admin/DanhMuc/danhmuc_insert.php";
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
        include "views/admin/DanhMuc/danhmuc_update.php";
    }
    public function delete_danhmuc($id){
        $arr_tuor=$this->tuorquery->find($id);
        if ($arr_tuor->danhmuc_id == $id){
            echo "<script> 
            alert('Không Thể Xóa');
            window.location.href='?action=tuor_danhmuc';
            </script>
            ";
        }
       $a = $this->danhmucquery->delete($id);
       if($a == 1){
        header("LOcation: ?action=tuor_danhmuc");
       }else{
        echo "lỗi";
       }
    }


    public function all_kehoachkh(){
        $arr_kehoachkh=$this->kehoachkhquery->all();
        include "views/admin/Kehoach/Kehoach_list.php";
    }
    public function kehoachkh_hdv(){
        $arr_kehoachkh=$this->kehoachkhquery->all();
        include "views/HDV/Kehoach_list.php";
    }
     public function insert_kehoachkh(){
        $arr_phienban=$this->phienbanquery->all();
        $arr_lichtrinh=$this->lichtrinhquery->all();
        $arr_nhansu=$this->UsersQuery->getAll();
        $kehoachkh = new kehoachkh();
        if(isset($_POST["nut"])){
            $kehoachkh->phienban_id = trim($_POST["phienban_id"]);
            $kehoachkh->lichtrinh_id = trim($_POST["lichtrinh_id"]);
            $kehoachkh->nhansu_id = trim($_POST["nhansu_id"]);
            $kehoachkh->diemtaptrung = trim($_POST["diemtaptrung"]);
            $data = $this->kehoachkhquery->insert($kehoachkh);
            if($data == 1){
                header("Location: ?action=kehoachkh-list");
            }
        }
        include "views/admin/Kehoach/Kehoachkh_insert.php";
    }
    public function update_kehoachkh($id){
         $arr_phienban=$this->phienbanquery->all();
        $arr_lichtrinh=$this->lichtrinhquery->all();
        $arr_nhansu=$this->UsersQuery->getAll();
        $arr_kehoachkh = $this->kehoachkhquery->find($id);
        $kehoachkh = new kehoachkh();
        $kehoachkh->id = $id;
        if(isset($_POST["nut"])){
            $kehoachkh->phienban_id = trim($_POST["phienban_id"]);
            $kehoachkh->lichtrinh_id = trim($_POST["lichtrinh_id"]);
            $kehoachkh->nhansu_id = trim($_POST["nhansu_id"]);
            $kehoachkh->diemtaptrung = trim($_POST["diemtaptrung"]);
            $data = $this->kehoachkhquery->update($kehoachkh);
            if($data == 1){
                header("Location: ?action=kehoachkh-list");
            }else{
                header("Location: ?action=kehoachkh-list");
            }
        }
        include "views/admin/Kehoach/Kehoachkh_update.php";
    }
    public function delete_kehoachkh($id){
        $arr_tuor=$this->tuorquery->find($id);
        if ($arr_tuor->kehoachkh_id == $id){
            echo "<script> 
            alert('Không Thể Xóa');
            window.location.href='?action=kehoachkh-list';
            </script>
            ";
        }
       $a = $this->kehoachkhquery->delete($id);
       if($a == 1){
        header("LOcation: ?action=kehoachkh-list");
       }else{
        echo "lỗi";
       }
    }
}