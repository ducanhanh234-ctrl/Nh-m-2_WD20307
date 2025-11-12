<?php
class DAcontroller {
    public $tuorquery;
    public $phienbanquery;
    public function __construct(){
        $this->tuorquery = new tuorquery();
        $this->phienbanquery = new phienbanquery();
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
       include "views/admin/tuor_list.php";
    }
    public function phienban(){
       $arr_phienban = $this->phienbanquery->all();
       include "views/admin/phienban_list.php";
    }
}