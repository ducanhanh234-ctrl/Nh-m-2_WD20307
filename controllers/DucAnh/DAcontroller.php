<?php
class DAcontroller {
    public function __construct(){

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
}