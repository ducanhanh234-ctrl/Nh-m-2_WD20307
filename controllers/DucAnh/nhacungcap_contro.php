<?php
class nhacungcap_contro{
    public $dichvu_tuorquery;
    public $nhacungcapquery;
    public function __construct(){
        $this->dichvu_tuorquery = new dichvu_tuorquery();
        $this->nhacungcapquery = new nhacungcapquery();
    }
    public function nhacungcap_list(){
        $arr_nhacungcap = $this->nhacungcapquery->all();
        include "views/admin/nhacungcap_list.php";
    }
    public function insert_nhacungcap(){
        $arr_dichvu = $this->dichvu_tuorquery->all();
        $nhacungcap = new nhacungcap();
        if(isset($_POST["nut"])){
            $nhacungcap->ten_don_vi = trim($_POST["ten_don_vi"]);
            $nhacungcap->diachi = trim($_POST["diachi"]);
            $nhacungcap->lienhe = trim($_POST["lienhe"]);
            $nhacungcap->nang_luc_cung_cap = trim($_POST["nang_luc_cung_cap"]);
            $nhacungcap->dichvu_tuor_id = trim($_POST["dichvu_tuor_id"]);
            
            $data = $this->nhacungcapquery->insert($nhacungcap);
            if($data == 1){
                header("Location: ?action=nhacungcap-list");
            }
        }
     include "views/admin/insert_nhacungcap.php";
    }
    public function update_nhacungcap($id){
        $arr_find = $this->nhacungcapquery->find($id);
        $arr_dichvu = $this->dichvu_tuorquery->all();
        $nhacungcap = new nhacungcap();
        $nhacungcap->id = $id;
        if(isset($_POST["nut"])){
            $nhacungcap->ten_don_vi = trim($_POST["ten_don_vi"]);
            $nhacungcap->diachi = trim($_POST["diachi"]);
            $nhacungcap->lienhe = trim($_POST["lienhe"]);
            $nhacungcap->nang_luc_cung_cap = trim($_POST["nang_luc_cung_cap"]);
            $nhacungcap->dichvu_tuor_id = trim($_POST["dichvu_tuor_id"]);
            
            $data = $this->nhacungcapquery->update($nhacungcap);
            if($data == 1){
                header("Location: ?action=nhacungcap-list");
            }else{
                header("Location: ?action=nhacungcap-list");

            }
        }
     include "views/admin/update_nhacungcap.php";
    }
    public function delete_nhacungcap($id){
        $data = $this->nhacungcapquery->delete($id);
        if($data == 1){
            header("Location: ?action=nhacungcap-list");
        }else{
            echo "Lỗi";
        }
    }
}