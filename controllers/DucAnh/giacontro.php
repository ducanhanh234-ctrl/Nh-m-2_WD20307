<?php
class giacontro{
    public $giasaucungquery;
    public $phienbanquery;
    public $thoidiem_pricequery;
    public $dichvu_pricequery;
    public $doituongquery;
    public function __construct(){
        $this->giasaucungquery = new giasaucungquery();
        $this->phienbanquery = new phienbanquery();
        $this->thoidiem_pricequery = new thoidiem_pricequery();
        $this->dichvu_pricequery = new dichvu_pricequery();
        $this->doituongquery = new doituongquery();
    }
    public function giasaucung_list(){
        $arr_giasaucung = $this->giasaucungquery->all();
        include "views/admin/giasaucung/gia.php";
    }
    public function giasaucung_insert(){
        $arr_phienban = $this->phienbanquery->all();
        $arr_thoidiem = $this->thoidiem_pricequery->all();
        $arr_dichvu = $this->dichvu_pricequery->all();
        $arr_doituong = $this->doituongquery->all();
       
        $giasaucung = new giasaucung();
        if(isset($_POST["nut"])){
            $giasaucung->phienban_id = trim($_POST["phienban_id"]);
            $giasaucung->doituong_id = trim($_POST["doituong_id"]);
            $giasaucung->thoidiem_id = trim($_POST["thoidiem_id"]);
            $giasaucung->dvkemtheo_id = trim($_POST["dvkemtheo_id"]);
            $giasaucung->tong_gia = trim($_POST["tong_gia"]);
            
            $data = $this->giasaucungquery->insert($giasaucung);
            if($data == 1){
                header("Location: ?action=gia-list");
            }
        }
     include "views/admin/giasaucung/insert_giasaucung.php";
    }
    public function giasaucung_update($id){
        $arr_find = $this->giasaucungquery->find($id);
        $arr_dichvu = $this->dichvu_pricequery->all();
        $arr_doituong = $this->doituongquery->all();
        $arr_phienban = $this->phienbanquery->all();
        $arr_thoidiem = $this->thoidiem_pricequery->all();
        $giasaucung = new giasaucung();
        $giasaucung->id = $id;
        if(isset($_POST["nut"])){
            $giasaucung->phienban_id = trim($_POST["phienban_id"]);
            $giasaucung->doituong_id = trim($_POST["doituong_id"]);
            $giasaucung->thoidiem_id = trim($_POST["thoidiem_id"]);
            $giasaucung->dvkemtheo_id = trim($_POST["dvkemtheo_id"]);
            $giasaucung->tong_gia = trim($_POST["tong_gia"]);
            
            $data = $this->giasaucungquery->update($giasaucung);
            if($data == 1){
                header("Location: ?action=gia-list");
            }else{
                header("Location: ?action=gia-list");

            }
        }
     include "views/admin/giasaucung/update_giasaucung.php";
    }
    public function giasaucung_delete($id){
        $data = $this->giasaucungquery->delete($id);
        if($data == 1){
            header("Location: ?action=gia-list");
        }else{
            echo "Lỗi";
        }
    }
}