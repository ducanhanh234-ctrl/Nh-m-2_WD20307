<?php
class PhanHoiModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả phản hồi
    public function getAll() {
        $sql = "
            SELECT 
                p.id,
                p.noidung,
                p.muc_do_hai_long,
                p.ngay_tao,
                t.name AS ten_tour,
                d.loai_dichvu_tuor AS ten_dichvu,
                n.ten_don_vi AS ten_nhacungcap
            FROM phanhoidanhgia p
            LEFT JOIN tuor t ON p.tuor_id = t.id
            LEFT JOIN dichvu_tuor d ON p.dichvu_tuor_id = d.id
            LEFT JOIN nha_cung_cap n ON p.nhacungcap_id = n.id
            ORDER BY p.id DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 phản hồi theo ID (dùng khi sửa)
    public function getById($id) {
        $sql = "SELECT * FROM phanhoidanhgia WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách tour
    public function getTours() {
        $sql = "SELECT id, name FROM tuor ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách dịch vụ của tour
    public function getDichVu() {
        $sql = "SELECT id, loai_dichvu_tuor FROM dichvu_tuor ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy nhà cung cấp
    public function getNhaCungCap() {
        $sql = "SELECT id, ten_don_vi FROM nha_cung_cap ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm phản hồi
    public function insert($data) {
        $sql = "INSERT INTO phanhoidanhgia 
                (noidung, tuor_id, dichvu_tuor_id, nhacungcap_id, muc_do_hai_long, ngay_tao)
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['noidung'],
            $data['tuor_id'],
            $data['dichvu_tuor_id'],
            $data['nhacungcap_id'],
            $data['muc_do_hai_long']
        ]);
    }

    // Cập nhật phản hồi
    public function update($id, $data) {
        $sql = "UPDATE phanhoidanhgia 
                SET noidung = ?, tuor_id = ?, dichvu_tuor_id = ?, nhacungcap_id = ?, muc_do_hai_long = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['noidung'],
            $data['tuor_id'],
            $data['dichvu_tuor_id'],
            $data['nhacungcap_id'],
            $data['muc_do_hai_long'],
            $id
        ]);
    }

    // Xóa phản hồi
    public function delete($id) {
        $sql = "DELETE FROM phanhoidanhgia WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
