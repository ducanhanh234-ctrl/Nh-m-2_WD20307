<?php
class doanhthucontro{
    public $doanhthuquery;
    public function __construct(){
        $this->doanhthuquery = new doanhthuquery();
    }
    //hàm doanh thu
    //doanhthu
    public function doanhthu_list(){
        $arr = $this->doanhthuquery->all();
        include "views/admin/doanhthu/list_doanhthu.php";
    }
}