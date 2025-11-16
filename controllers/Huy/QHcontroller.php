<?php
require_once './models/Huy/UsersQuery.php';

class QHController
{
    private $userQuery;

    public function __construct()
    {
        $this->userQuery = new UsersQuery();
    }

    public function listUsers()
    {
        $users = $this->userQuery->getAll();

        require_once './views/User/ListUser.php';

       
    }

    public function createUsers()
    {
        require './views/User/CreateUser.php';
    }

    public function storeUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'              => $_POST['name'],
                'ngaysinh'          => $_POST['ngaysinh'],
                'avatar'            => $_POST['avatar'],
                'sdt'               => $_POST['sdt'],
                'email'             => $_POST['email'],
                'chungchi'          => $_POST['chungchi'],
                'ngonngu'           => $_POST['ngonngu'],
                'kinhnghiem'        => $_POST['kinhnghiem'],
                'lichsudantuor'     => $_POST['lichsudantuor'], 
                'danhgianangluc'    => $_POST['danhgianangluc'],
                'suckhoe'           => $_POST['suckhoe'],
                'loaihdv_id'        => $_POST['loaihdv_id'],
                'chucvu'            => $_POST['chucvu']
            ];

            $this->userQuery->insert($data);

            header("Location: index.php?action=listUsers");
            exit;
        }
    }

    public function editUsers($id)
    {
        $user = $this->userQuery->getById($id);
        require './views/User/EditUser.php';
    }

    public function updateUsers($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'              => $_POST['name'],
                'ngaysinh'          => $_POST['ngaysinh'],
                'avatar'            => $_POST['avatar'],
                'sdt'               => $_POST['sdt'],
                'email'             => $_POST['email'],
                'chungchi'          => $_POST['chungchi'],
                'ngonngu'           => $_POST['ngonngu'],
                'kinhnghiem'        => $_POST['kinhnghiem'],
                'lichsudantuor'     => $_POST['lichsudantuor'],
                'danhgianangluc'    => $_POST['danhgianangluc'],
                'suckhoe'           => $_POST['suckhoe'],
                'loaihdv_id'        => $_POST['loaihdv_id'],
                'chucvu'            => $_POST['chucvu']
            ];

            $this->userQuery->update($id, $data);

            header("Location: index.php?action=listUsers");
            exit;
        }
    }

    public function deleteUsers($id)
    {
        $this->userQuery->delete($id);
        header("Location: index.php?action=listUsers");
        exit;
    }
}
?>
