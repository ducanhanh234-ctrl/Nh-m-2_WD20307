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



require_once './controllers/Huy/QHcontroller.php';
require_once './controllers/Huy/PhanhoiController.php';




$action = $_GET['action'] ?? '/';
$id = $_GET['id'] ?? '/';
require_once './controllers/BaoToan/BTcontroller.php';
require_once './controllers/Huy/QHcontroller.php';
require_once './controllers/DucAnh/DAcontroller.php';
require_once './controllers/HoangSon/HScontroller.php';
require_once './controllers/DucAnh/nhacungcap_contro.php';
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
    // ! Quản lí booking
    'manageBookings' => (new BTcontroller) -> manageBookings(),
    'UsersBookingList' => (new BTcontroller) -> UsersBookingList(),
    'assignHdv' => (new BTcontroller) -> assignHdv(),
    'addBooking' => (new BTcontroller) -> addBooking(),
    'deleteBooking' => (new BTcontroller) -> deleteBooking(),
    'addNewBooking' => (new BTcontroller) -> addNewBooking(),
    'editBooking' => (new BTcontroller) -> editBooking(),
    'editNewBooking' => (new BTcontroller) -> editNewBooking(),
    'danhSachKhach' => (new BTcontroller) -> danhSachKhach(),
    // ! Quản lí Trạng thái Booking
    'quanlitrangthai' => (new BTcontroller) -> quanlitrangthai(),
    'changeStatus' => (new BTcontroller) -> changeStatus(),

    // 5 Linh Trang Quản Lý Danh Mục Tuor
    'tuor_danhmuc'  => (new HScontroller)->all_danhmuc(),
    // 6 Linh Trang Thêm Mới Danh Mục Tuor
    'danhmuc_insert'  => (new HScontroller)->insert_danhmuc(),
    // 7 Linh Trang Cập Nhật Danh Mục Tuor
    'danhmuc_update'  => (new HScontroller)->update_danhmuc($id),
    // 8 Linh Trang Xóa Danh Mục Tuor
    'danhmuc_delete'  => (new HScontroller)->delete_danhmuc($id),
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
    'tuor-update'     => (new DAcontroller)->update_tuor($id),
    // 12 Link Chức Năng Xóa Tuor
    'tuor-delete'     => (new DAcontroller)->delete_tuor($id),

    // Quản Lý Nhà Cung cấp
    'nhacungcap-list' => (new nhacungcap_contro)->nhacungcap_list(),
    'nhacungcap-insert' => (new nhacungcap_contro)->insert_nhacungcap(),
    'nhacungcap-update' => (new nhacungcap_contro)->update_nhacungcap($id),
    'nhacungcap-delete' => (new nhacungcap_contro)->delete_nhacungcap($id),


    



    // Quản Lý Users
    'listUsers' => (new QHController)->listUsers(),
    'createUsers' => (new QHController)->createUsers(),
    'storeUsers' => (new QHController)->storeUsers(),
    'editUsers' => (new QHController)->editUsers($id),
    'updateUsers' => (new QHController)->updateUsers($id),
    'deleteUsers' => (new QHController)->deleteUsers($id),



  
    
    // Quản Lý Kế Hoạch Khởi Hành
    'kehoachkh-list' => (new HScontroller)->all_kehoachkh(),
    'kehoachkh-insert' => (new HScontroller)->insert_kehoachkh(),
    'nhacungcap-update' => (new HScontroller)->update_nhacungcap($id),
    'nhacungcap-delete' => (new HScontroller)->delete_nhacungcap($id),

    // Quản Lý Giá

    'gia-list' => (new giacontro)->giasaucung_list(),
    'gia-insert' => (new giacontro)->giasaucung_insert(),
    'gia-update' => (new giacontro)->giasaucung_update($id),
    'gia-delete' => (new giacontro)->giasaucung_delete($id),




    
    // Quản lý phản hồi đánh giá
    'phanhoi-list'   => (new PhanHoiController())->index(),
    'phanhoi-create' => (new PhanHoiController())->create(),
    'phanhoi-store'  => (new PhanHoiController())->store(),
    'phanhoi-edit'   => ($id > 0) ? (new PhanHoiController())->edit($id) : die("ID không hợp lệ!"),
    'phanhoi-update' => ($id > 0) ? (new PhanHoiController())->update($id) : die("ID không hợp lệ!"),
    'phanhoi-delete' => ($id > 0) ? (new PhanHoiController())->delete($id) : die("ID không hợp lệ!"),

};
    

    

    



?>

