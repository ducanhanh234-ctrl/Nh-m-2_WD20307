<?php
// Viết theo đúng thứ tự
// VD: 
// 1
//    '/'         => (new HomeController)->index(),
// 2
// Cú Pháp Hàm Update trong base này
// upload_file('image_upload',$_FILES["file_upload"])
// Cú Pháp Điều hướng
// VD: Điều Đến Trang index.php
// http://localhost/Nh%C3%B3m%202_WD20307/?action=index
$action = $_GET['action'] ?? '/';
$id = $_GET['id'] ?? '/';
match ($action) {
    // 1 Link Trang Mặc Định
    '/'         => (new HomeController)->index(),
    // 2 Link Trang Khung Admin
    'index'         => (new DAcontroller)->index(),
    // 3 Link Trang Đăng Nhập
    'login'         => (new DAcontroller)->login(),
    // 4 Link Trang Đăng Ký
    'logup'         => (new DAcontroller)->logup(),
    // 5 Link Trang Quản Lý Tuor
    'tuor-list'     => (new DAcontroller)->tuor(),
    // 6 Link Trang Quản Lý Phiên BẢn
    'phienban-list'     => (new DAcontroller)->phienban(),
    // 7 Link Trang Thêm Mới Phiên Bản
    'phienban-insert'     => (new DAcontroller)->insert_phienban(),
    // 8 Link Trang Cập Nhật Phiên Bản
    'phienban-update'     => (new DAcontroller)->update_phienban($id),
    // 9 Link Chức Năng Xóa Phiên Bản
    'phienban-delete'     => (new DAcontroller)->delete_phienban($id),
    // 10 Link Trang Thêm Mới Tuor
    'tuor-insert'     => (new DAcontroller)->insert_tuor(),
    // 11 Link Trang Cập Nhật Tuor
    'tuor-update'     => (new DAcontroller)->update_tuor(),
    // 12 Link Chức Năng Xóa Tuor
    'tuor-delete'     => (new DAcontroller)->delete_tuor(),
};