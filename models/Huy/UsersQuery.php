<?php
require_once __DIR__ . '/../BaseModel.php';


class UsersQuery extends BaseModel {
    public $name;
    public $ngaysinh;
    public $avatar;

    public $sdt;    

    public $email;
    public $chungchi;
    public $ngonngu;
    public $kinhnghiem;
    public $lichsudantuor; // thống nhất tên
    public $danhgianangluc;
    public $suckhoe;
    public $loaihdv_id;
    public $chucvu;

    public function getAll() {
       
        $sql = "SELECT nhansu.*, loai_hdv.name AS loaihdv_name FROM nhansu
                LEFT JOIN loai_hdv ON nhansu.loaihdv_id = loai_hdv.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM nhansu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $sql = "INSERT INTO nhansu 
        (name, ngaysinh, avatar, sdt, email, chungchi, ngonngu, kinhnghiem, 
         lichsudantuor, danhgianangluc, suckhoe, loaihdv_id, chucvu)
        VALUES 
        (:name, :ngaysinh, :avatar, :sdt, :email, :chungchi, :ngonngu, :kinhnghiem,
         :lichsudantuor, :danhgianangluc, :suckhoe, :loaihdv_id, :chucvu)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $data['id'] = $id;
        $sql = "UPDATE nhansu SET 
                name=:name, 
                ngaysinh=:ngaysinh,
                avatar=:avatar,
                sdt=:sdt,
                email=:email,
                chungchi=:chungchi,
                ngonngu=:ngonngu,
                kinhnghiem=:kinhnghiem,
                lichsudantuor=:lichsudantuor,
                danhgianangluc=:danhgianangluc,
                suckhoe=:suckhoe,
                loaihdv_id=:loaihdv_id,
                chucvu=:chucvu
                WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM nhansu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
