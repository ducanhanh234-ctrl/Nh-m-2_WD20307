<?php
class BTcontroller {
    protected $model;
    protected $tour;
    protected $user;
    protected $BtHdv;

    public function __construct(){
        // Kết nối model ở constructor để controller có thể tái sử dụng
        $this->model = new BookingModel();
        $this->tour = new TourModel();
        $this ->user = new UsersQuery();
        $this ->BtHdv = new BaoToanHDV();
    }

    public function manageBookings(){
        $bookings = $this->model->GetAllBooking();
        // debug($bookings);
        include  './views/admin/Booking/manageBookings.php';
    }

    public function deleteBooking() {
        $id = $_GET['id'];
        $result = $this -> model -> deleteBooking($id);
        
        if ($result) {
            $_SESSION['success_message'] = "Xóa booking thành công!";
        } else {
            $_SESSION['error_message'] = "Không thể xóa booking này vì khách hàng đã thanh toán!";
        }
        
        header('location: index.php?action=manageBookings');
    }

    public function UsersBookingList() {
        $id = $_GET['id'];
        $usersBooking = $this -> user -> getAll();
        // debug($usersBooking);
        include './views/admin/Booking/UsersBookingList.php';
    }

    public function assignHdv() {
        $booking_id = $_GET['booking_id'] ?? null;
        $hdv_id = $_GET['hdv_id'] ?? null;
        if ($booking_id && $hdv_id) {
            $ok = $this->model->assignHdv((int)$booking_id, (int)$hdv_id);
            if ($ok) {
                header('Location: index.php?action=manageBookings');
                exit;
            } else {
                header('Location: index.php?action=UsersBookingList&id=' . urlencode($booking_id));
                exit;
            }
        }
        header('Location: index.php?action=manageBookings');
        exit;
    }

    public function addBooking() {
        $listTour = $this -> tour -> GetAllTour();
        include "views/admin/Booking/addBooking.php";
    }
    
    public function addNewBooking() {
        $tenkhach = $_POST['tenkhach']; 
        $sdt = $_POST['sdt']; 
        $email = $_POST['email']; 
        $cccd = $_POST['cccd']; 
        $tuor_id = $_POST['tuor_id']; 
        $soluong_nguoi = $_POST['soluong_nguoi']; 
        $gioitinh = $_POST['gioitinh']; 
        $ngaykhoi_hanh = $_POST['ngaykhoi_hanh']; 
        $songay = $_POST['songay']; 
        $yeucaudacbiet = $_POST['yeucaudacbiet']; 
        //! Thêm booking mới
        $booking_id = $this->model->addNewBooking($tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet);


        $danhsach_khach = $_POST['danhsach_khach'];

        if(!empty($danhsach_khach)) {
            $danhsach_khach = json_decode($danhsach_khach, true);

            foreach($danhsach_khach as $khach) {
                $hovaten = $khach['name'];
                $ngaysinh = $khach['birthday'];
                $gioitinh = $khach['gender'];
                $cccd = $khach['cccd'];
                $sdt = $khach['phone'];

                $this -> model -> addBookingChiTiet($booking_id, $hovaten, $ngaysinh, $gioitinh, $cccd, $sdt);
            }
        }
        header('location: index.php?action=manageBookings');
    }
    
    
    
    public function editBooking() {
        $id = $_GET['id'];
        $getBookingId = $this -> model -> GetBookingId($id);
        $listTour = $this -> tour -> GetAllTour();
        include "views/admin/Booking/editBooking.php";
    }
    
    public function editNewBooking() {
        $id = $_GET['id'];
        $tenkhach = $_POST['tenkhach'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $cccd = $_POST['cccd'];
        $tuor_id = $_POST['tuor_id'];
        $soluong_nguoi = $_POST['soluong_nguoi'];
        $gioitinh = $_POST['gioitinh'];
        $ngaykhoi_hanh = $_POST['ngaykhoi_hanh'];
        $songay = $_POST['songay'];
        $yeucaudacbiet = $_POST['yeucaudacbiet'];
        
        $this->model->editNewBooking($id, $tenkhach, $sdt, $email, $cccd, $tuor_id, $soluong_nguoi, $gioitinh, $ngaykhoi_hanh, $songay, $yeucaudacbiet);
        header('location: index.php?action=manageBookings');
    }

    public function quanlitrangthai() {
        $bookings = $this->model->GetAllBooking();
        include "views/admin/Booking/quanlitrangthai.php";
    }

    // Thay đổi trạng thái (sử dụng POST)
    public function changeStatus() {
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        $status = $_POST['status'] ?? $_GET['status'] ?? null;
        if ($id !== null && $status !== null) {
            // đảm bảo là số nguyên
            $id = (int)$id;
            $status = (int)$status;
            $this->model->updateStatus($id, $status);
        }
        header('Location: index.php?action=quanlitrangthai');
        exit;
    }

    public function danhSachKhach() {
        $id = $_GET['id'];
        $booking = $this -> model -> GetDanhSachKhach($id);
        include "views/admin/Booking/danhSachKhach.php";
    }

    public function listUserHDV() {
        $id = $_GET['id'] ?? 1;
        $bookingById = $this -> BtHdv -> listUserHDV($id);
        include 'views/HDV/listUserHDV.php';
    }

    public function danhSachDoanHDV() {
        $id = $_GET['id'];
        $booking = $this -> model -> GetDanhSachKhach($id);
        include "views/HDV/danhSachDoanHDV.php";
    }

    public function nhatKiTour() {
        $nhatKiTour = $this -> BtHdv -> nhatKiTour();
        include 'views/HDV/nhatKiTour.php';
    }

    public function themNhatKiTour() {
        // Lấy danh sách booking để chọn trong form thêm nhật ký
        $id = $_GET['id'] ?? 1;
        $listBooking = $this -> BtHdv -> listUserHDV($id);
        include 'views/HDV/themNhatKiTour.php';
    }

    public function updateXuLy() {
        $id = $_GET['id'];
        $cach_xu_ly = $_POST['cach_xu_ly'] ?? '';
        
        if ($id && !empty($cach_xu_ly)) {
            $result = $this->BtHdv->updateXuLy($id, $cach_xu_ly);
            if ($result) {
                $_SESSION['success_message'] = "Cập nhật cách xử lý thành công!";
            } 
        }
        
        header('location: index.php?action=nhatKiTour');
        exit;
    }

    public function addNhatKy() {
        $booking_id = $_POST['booking_id'] ?? '';
        $ngay_thu = $_POST['ngay_thu'] ?? '';
        $su_co = trim($_POST['su_co'] ?? '');
        $hoat_dong_noi_bat = trim($_POST['hoat_dong_noi_bat'] ?? '');
        $cach_xu_ly = trim($_POST['cach_xu_ly'] ?? '');
        
        // Xử lý upload ảnh
        $image = '';
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image_upload/';
            $uploadPath = PATH_ASSETS_UPLOADS . $uploadDir;
            
            // Tạo tên file unique
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['image']['name']);
            $targetFile = $uploadPath . $filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = 'assets/uploads/' . $uploadDir . $filename;
            } else {
                $_SESSION['error_message'] = "Lỗi khi upload ảnh!";
                header('location: index.php?action=themNhatKiTour');
                exit;   
            }
        }
        
        if (!empty($booking_id) && !empty($ngay_thu)) {
            $result = $this->BtHdv->addNhatKy($booking_id, $ngay_thu, $image, $su_co, $hoat_dong_noi_bat, $cach_xu_ly);
            if ($result) {
                $_SESSION['success_message'] = "Thêm nhật ký thành công!";
            } else {
                $_SESSION['error_message'] = "Có lỗi xảy ra khi thêm nhật ký!";
            }
        } else {
            $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin!";
        }
        
        header('location: index.php?action=nhatKiTour');
        exit;
    }
}
