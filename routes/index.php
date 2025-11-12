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
    // 5 Linh Trang Quản Lý Danh Mục Tuor
    'tuor_danhmuc'  => (new HScontroller)->all_danhmuc(),
    // 6 Linh Trang Thêm Mới Danh Mục Tuor
    'danhmuc_insert'  => (new HScontroller)->insert_danhmuc(),
    // 7 Linh Trang Cập Nhật Danh Mục Tuor
    'danhmuc_update'  => (new HScontroller)->update_danhmuc($id),
    // 8 Linh Trang Xóa Danh Mục Tuor
    'danhmuc_delete'  => (new HScontroller)->delete_danhmuc($id),
};