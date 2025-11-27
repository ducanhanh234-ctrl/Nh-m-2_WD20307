<?php
class CheckinController {

    private $model;

    public function __construct() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=group2_wd20307;charset=utf8mb4", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Lỗi kết nối CSDL!");
        }
        $this->model = new CheckinModel($db);

        if (!isset($_SESSION['hdv_id'])) {
            $_SESSION['hdv_id'] = 1;
        }
    }

    public function index() {
        $tours = $this->model->getToursByHDV($_SESSION['hdv_id']);
        
        require './views/HDV/danh_sach_tuor.php';  // ĐÃ SỬA ĐÚNG
    }

    public function checkin() {
        $tuor_id = $_GET['tuor_id'] ?? null;
        if (!$tuor_id) die("Không tìm thấy tour!");

        $diem = $_GET['diem'] ?? 'Sân bay Tân Sơn Nhất';

        $khach_list = $this->model->getKhachByTourAndDiem($tuor_id, $diem);
        $cac_chang = $this->model->getDiemDaCheck($tuor_id);

        require './views/HDV/checkin_doan.php';  // ĐÃ SỬA ĐÚNG
    }

    public function save() {
        $tuor_id = $_POST['tuor_id'];
        $diem    = trim($_POST['diem_taptrung']);

        foreach ($_POST['khach_id'] as $khach_id) {
            $tt = $_POST['trangthai'][$khach_id] ?? 1;
            $gc = $_POST['ghichu'][$khach_id] ?? '';
            $this->model->updateCheckin($khach_id, $diem, $tt, $gc);
        }

        $_SESSION['msg'] = "Đã lưu điểm danh thành công tại: <strong>$diem</strong>";
        header("Location: ?action=hdv-checkin&tuor_id=$tuor_id&diem=" . urlencode($diem));
        exit();
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>