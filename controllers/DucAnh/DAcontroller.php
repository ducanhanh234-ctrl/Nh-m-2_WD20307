<?php
class DAcontroller {
    public $tuorquery;
    public $phienbanquery;
    public $loaipbquery;
    public $anh_tuorquery;
    public $chinhsach_tuorquery;
    public $nhacungcapquery;
    public $khachsanquery;
    public $danhmucquery;
    public $giasaucungquery;
    public $BookingModel;
    public function __construct(){
        $this->tuorquery = new tuorquery();
        $this->phienbanquery = new phienbanquery();
        $this->loaipbquery = new loaipbquery();
        $this->anh_tuorquery = new anh_tuorquery();
        $this->chinhsach_tuorquery = new chinhsach_tuorquery();
        $this->nhacungcapquery = new nhacungcapquery();
        $this->khachsanquery = new khachsanquery();
        $this->danhmucquery = new danhmucquery();
        $this->giasaucungquery = new giasaucungquery();
        $this->BookingModel = new BookingModel();
    }
    public function index(){
        include "views/admin/index.php";
    }
    public function login(){
        include "views/login.php";
    }
    public function logup(){
        include "views/logup.php";
    }
    public function tuor(){
       $arr_tuor = $this->tuorquery->all();
       include "views/admin/Tour/tuor_list.php";
    }
    public function phienban(){
       $arr_phienban = $this->phienbanquery->all();
       $arr_gia = $this->giasaucungquery->all();
       include "views/admin/PhienBan/phienban_list.php";
    }
    public function insert_phienban(){
        $arr_loaipb = $this->loaipbquery->all();
        $arr_anhtuor = $this->anh_tuorquery->all();
        $arr_chinhsach = $this->chinhsach_tuorquery->all();
        $arr_nhacungcap = $this->nhacungcapquery->all();
        $arr_khachsan = $this->khachsanquery->all();
        $phienban = new phienban();
        if(isset($_POST["nut"])){
            $phienban->name = trim($_POST["name"]);
            $phienban->loaipb_id = trim($_POST["loaipb_id"]);
            $phienban->anh_tuor_id = trim($_POST["anh_tuor_id"]);
            $phienban->chinhsach_tuor_id = trim($_POST["chinhsach_tuor_id"]);
            $phienban->nhacungcap_id = trim($_POST["nhacungcap_id"]);
            $phienban->price = trim($_POST["price"]);
            $phienban->thoigian = trim($_POST["thoigian"]);
            $phienban->phuongtien = trim($_POST["phuongtien"]);
            $phienban->khoihanh = trim($_POST["khoihanh"]);
            $phienban->khachsan_id = trim($_POST["khachsan_id"]);
            $data = $this->phienbanquery->insert($phienban);
            if($data == 1){
                header("Location: ?action=phienban-list");
            }
        }
     include "views/admin/PhienBan/insert_pb.php";
    }
    public function update_phienban($id){
        $arr_find = $this->phienbanquery->find($id);
        $arr_loaipb = $this->loaipbquery->all();
        $arr_anhtuor = $this->anh_tuorquery->all();
        $arr_chinhsach = $this->chinhsach_tuorquery->all();
        $arr_nhacungcap = $this->nhacungcapquery->all();
        $arr_khachsan = $this->khachsanquery->all();
        $phienban = new phienban();
        if(isset($_POST["nut"])){
            $phienban->name = trim($_POST["name"]);
            $phienban->loaipb_id = trim($_POST["loaipb_id"]);
            $phienban->anh_tuor_id = trim($_POST["anh_tuor_id"]);
            $phienban->chinhsach_tuor_id = trim($_POST["chinhsach_tuor_id"]);
            $phienban->nhacungcap_id = trim($_POST["nhacungcap_id"]);
            $phienban->price = trim($_POST["price"]);
            $phienban->thoigian = trim($_POST["thoigian"]);
            $phienban->phuongtien = trim($_POST["phuongtien"]);
            $phienban->khoihanh = trim($_POST["khoihanh"]);
            $phienban->khachsan_id = trim($_POST["khachsan_id"]);
            $data = $this->phienbanquery->insert($phienban);
            if($data == 1){
                header("Location: ?action=phienban-list");
            }else{
                header("Location: ?action=phienban-list");
            }
        }
     include "views/admin/PhienBan/update_pb.php";
    }
    public function delete_phienban($id){
        $arr_tuor = $this->tuorquery->find($id);
        $arr_phienban = $this->phienbanquery->find($id);
        if($arr_phienban->id == $arr_tuor->phienban_id){
            echo "<script>
            alert('Không Xóa Đc Phiên Bản Này Vì trong tuor đã chọn phiên bản');
            window.location.href='?action=phienban-list'; 
            </script>";
            
        }
        $data = $this->phienbanquery->delete($id);
        if($data == 1){
            header("Location: ?action=phienban-list");
        }else{
            echo "Lỗi";
        }
    }
    public function insert_tuor(){
        $arr_danhmuc = $this->danhmucquery->all();
        $arr_phienban = $this->phienbanquery->all();
        $tuor = new tuor();
        if(isset($_POST["nut"])){
            $tuor->name = trim($_POST["name"]);
            $tuor->danhmuc_id = trim($_POST["danhmuc_id"]);
            $tuor->mota = trim($_POST["mota"]);
            $tuor->phienban_id = trim($_POST["phienban_id"]);
            $data = $this->tuorquery->insert($tuor);
            if($data == 1){
                header("Location: ?action=tuor-list");
            }
        }
     include "views/admin/Tour/insert_tuor.php";
    }
    public function update_tuor($id){
        $arr_find = $this->tuorquery->find($id);
        $arr_danhmuc = $this->danhmucquery->all();
        $arr_phienban = $this->phienbanquery->all();
        $tuor = new tuor();
        $tuor->id = $id;
        if(isset($_POST["nut"])){
            $tuor->name = trim($_POST["name"]);
            $tuor->danhmuc_id = trim($_POST["danhmuc_id"]);
            $tuor->mota = trim($_POST["mota"]);
            $tuor->phienban_id = trim($_POST["phienban_id"]);
            $data = $this->tuorquery->update($tuor);
            if($data == 1){
                header("Location: ?action=tuor-list");
            }else{
                header("Location: ?action=tuor-list");

            }
        }
     include "views/admin/Tour/update_tuor.php";
    }
    public function delete_tuor($id){
        $arr_booking = $this->BookingModel->GetBookingId($id);
        if($arr_booking['tuor_id'] == $id){
         echo "<script>
            alert('Không Xóa Đc Tuor Này Vì trong booking đã chọn ');
            window.location.href='?action=tuor-list'; 
            </script>";
        }
        $data = $this->tuorquery->delete($id);
        if($data == 1){
            header("Location: ?action=tuor-list");
        }else{
            echo "Lỗi";
        }
    }
}