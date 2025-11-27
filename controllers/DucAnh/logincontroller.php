<?php
class logincontroller{
    public $loginquery;
    public $UsersQuery;
    public function __construct(){
        $this->loginquery = new loginquery();
        $this->UsersQuery = new UsersQuery();
    }
    public function login_all(){
     $arr = $this->loginquery->all();
     include "views/admin/dangnhap/login.php";
    }
    public function login_update($id){
        $arr_find = $this->loginquery->find($id);
        $login = new login();
        $login->id = $id;
        if(isset($_POST["nut"])){
            $login->role = trim($_POST["role"]);
            $data = $this->loginquery->update($login);
            if($data == 1){
                header("Location: ?action=login-list");
            }else{
                header("Location: ?action=login-list");

            }
        }
     include "views/admin/dangnhap/login_update.php";
    }
}