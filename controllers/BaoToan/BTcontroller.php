<?php
class BTcontroller {
    protected $model;
    protected $tour;
    protected $user;

    public function __construct(){
        // Kết nối model ở constructor để controller có thể tái sử dụng
        $this->model = new BookingModel();
        $this->tour = new TourModel();
        $this ->user = new UsersQuery();
    }

    public function manageBookings(){
        $bookings = $this->model->GetAllBooking();
        // debug($bookings);
        include  './views/admin/Booking/manageBookings.php';
    }

    public function deleteBooking() {
        $id = $_GET['id'];
        $this -> model -> deleteBooking($id);
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
        $this -> model -> addNewBooking($tenkhach,$sdt,$email,$cccd,$tuor_id,$soluong_nguoi,$gioitinh,$ngaykhoi_hanh,$songay,$yeucaudacbiet);
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

}