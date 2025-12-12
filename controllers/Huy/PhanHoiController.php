<?php
require_once "models/Huy/PhanHoiModel.php";

class PhanHoiController {
    private $model;

    public function __construct() {
        $conn = new PDO("mysql:host=localhost;dbname=group2_wd20307;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->model = new PhanHoiModel($conn);
    }

    // Danh sách phản hồi
    public function index() {
        $feedbacks = $this->model->getAll();
        include "views/phanhoidanhgia/list.php";
    }

    // Form thêm phản hồi
    public function create() {
        $tours = $this->model->getTours();
        $dichvus = $this->model->getDichVu();
        $nhacungcaps = $this->model->getNhaCungCap();

        include "views/HDV/create.php";
    }

    // Lưu phản hồi
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'noidung'         => $_POST['noidung'] ?? '',
                'tuor_id'         => $_POST['tuor_id'] ?? '',
                'dichvu_tuor_id'  => $_POST['dichvu_tuor_id'] ?? '',
                'nhacungcap_id'   => $_POST['nhacungcap_id'] ?? '',
                'muc_do_hai_long' => $_POST['muc_do_hai_long'] ?? '',
                'nguoi_gui' => $_POST['nguoi_gui'] ?? '',
            ];

            $this->model->insert($data);
        }

        header("Location: index.php?action=phanhoi-list");
        exit;
    }

    // Form sửa phản hồi
    public function edit($id) {
        $feedback = $this->model->getById($id); // cần thêm hàm getById trong model
        $tours = $this->model->getTours();
        $dichvus = $this->model->getDichVu();
        $nhacungcaps = $this->model->getNhaCungCap();

        include "views/phanhoidanhgia/edit.php";
    }

    // Cập nhật phản hồi
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'noidung'         => $_POST['noidung'] ?? '',
                'tuor_id'         => $_POST['tuor_id'] ?? '',
                'dichvu_tuor_id'  => $_POST['dichvu_tuor_id'] ?? '',
                'nhacungcap_id'   => $_POST['nhacungcap_id'] ?? '',
                'muc_do_hai_long' => $_POST['muc_do_hai_long'] ?? '',
                'nguoi_gui' => $_POST['nguoi_gui'] ?? ''
            ];

            $this->model->update($id, $data); // cần thêm hàm update trong model
        }

        header("Location: index.php?action=phanhoi-list");
        exit;
    }

    // Xóa phản hồi
    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php?action=phanhoi-list");
        exit;
    }
}


