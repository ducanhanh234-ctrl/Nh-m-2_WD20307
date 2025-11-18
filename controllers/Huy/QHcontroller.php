<?php
require_once './models/Huy/UsersQuery.php';

class QHController
{
    private $userQuery;

    public function __construct()
    {
        $this->userQuery = new UsersQuery();
    }

    // Hiển thị danh sách user
    public function listUsers()
    {
        $users = $this->userQuery->getAll();
        require './views/User/ListUser.php';
    }

    // Hiển thị form thêm mới
    public function createUsers()
    {
        $loaiHDV = $this->userQuery->getLoaiHDV();
        require './views/User/CreateUser.php';
    }

    // Xử lý lưu user mới
    public function storeUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            // Xử lý avatar
            $avatar = 'uploads/default-avatar.jpg'; // mặc định
            if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['avatar']['name']);
                $avatar = $uploadDir . $filename;
                move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
            }

            // Xử lý chứng chỉ
            $chungchi = 'uploads/default-cert.jpg'; // mặc định
            if (!empty($_FILES['chungchi']['name']) && $_FILES['chungchi']['error'] === UPLOAD_ERR_OK) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['chungchi']['name']);
                $chungchi = $uploadDir . $filename;
                move_uploaded_file($_FILES['chungchi']['tmp_name'], $chungchi);
            }

            $loaihdv_id = $_POST['loaihdv_id'] ?? null;
            if (is_array($loaihdv_id)) $loaihdv_id = $loaihdv_id[0];

            $data = [
                'name'           => $_POST['name'] ?? '',
                'ngaysinh'       => $_POST['ngaysinh'] ?? '',
                'avatar'         => $avatar,
                'sdt'            => $_POST['sdt'] ?? '',
                'email'          => $_POST['email'] ?? '',
                'chungchi'       => $chungchi,
                'ngonngu'        => $_POST['ngonngu'] ?? '',
                'kinhnghiem'     => $_POST['kinhnghiem'] ?? '',
                'lichsudantuor'  => $_POST['lichsudantuor'] ?? '',
                'danhgianangluc' => $_POST['danhgianangluc'] ?? '',
                'suckhoe'        => $_POST['suckhoe'] ?? '',
                'loaihdv_id'     => $loaihdv_id,
                'chucvu'         => $_POST['chucvu'] ?? ''
            ];

            $this->userQuery->insert($data);

            header("Location: index.php?action=listUsers");
            exit;
        }
    }

    // Hiển thị form edit
    public function editUsers($id)
    {
        $user = $this->userQuery->getById($id);
        $loaiHDV = $this->userQuery->getLoaiHDV();
        require './views/User/EditUser.php';
    }

    // Xử lý update user
    public function updateUsers($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userQuery->getById($id);

            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            // Xử lý avatar
            $avatar = $user['avatar'] ?: 'uploads/default-avatar.jpg';
            if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['avatar']['name']);
                $avatar = $uploadDir . $filename;
                move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
            }

            // Xử lý chứng chỉ
            $chungchi = $user['chungchi'] ?: 'uploads/default-cert.jpg';
            if (!empty($_FILES['chungchi']['name']) && $_FILES['chungchi']['error'] === UPLOAD_ERR_OK) {
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['chungchi']['name']);
                $chungchi = $uploadDir . $filename;
                move_uploaded_file($_FILES['chungchi']['tmp_name'], $chungchi);
            }

            $loaihdv_id = $_POST['loaihdv_id'] ?? $user['loaihdv_id'];
            if (is_array($loaihdv_id)) $loaihdv_id = $loaihdv_id[0];

            $data = [
                'name'           => $_POST['name'] ?? $user['name'],
                'ngaysinh'       => $_POST['ngaysinh'] ?? $user['ngaysinh'],
                'avatar'         => $avatar,
                'sdt'            => $_POST['sdt'] ?? $user['sdt'],
                'email'          => $_POST['email'] ?? $user['email'],
                'chungchi'       => $chungchi,
                'ngonngu'        => $_POST['ngonngu'] ?? $user['ngonngu'],
                'kinhnghiem'     => $_POST['kinhnghiem'] ?? $user['kinhnghiem'],
                'lichsudantuor'  => $_POST['lichsudantuor'] ?? $user['lichsudantuor'],
                'danhgianangluc' => $_POST['danhgianangluc'] ?? $user['danhgianangluc'],
                'suckhoe'        => $_POST['suckhoe'] ?? $user['suckhoe'],
                'loaihdv_id'     => $loaihdv_id,
                'chucvu'         => $_POST['chucvu'] ?? $user['chucvu']
            ];

            $this->userQuery->update($id, $data);

            header("Location: index.php?action=listUsers");
            exit;
        }
    }

    // Xóa user
    public function deleteUsers($id)
    {
        $this->userQuery->delete($id);
        header("Location: index.php?action=listUsers");
        exit;
    }
}
?>
