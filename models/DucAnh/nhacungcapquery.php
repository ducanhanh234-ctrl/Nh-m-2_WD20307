<?php
class nhacungcapquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT nha_cung_cap.* , dichvu_tuor.loai_dichvu_tuor as dichvu_tuor_name 
FROM nha_cung_cap
JOIN dichvu_tuor ON nha_cung_cap.dichvu_tuor_id = dichvu_tuor.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $nhacungcap = new nhacungcap();
            $nhacungcap->id = $a["id"];
            $nhacungcap->ten_don_vi = $a["ten_don_vi"];
            $nhacungcap->diachi = $a["diachi"];
            $nhacungcap->lienhe = $a["lienhe"];
            $nhacungcap->nang_luc_cung_cap = $a["nang_luc_cung_cap"];
            $nhacungcap->dichvu_tuor_id = $a["dichvu_tuor_id"];
            $nhacungcap->dichvu_tuor_name = $a["dichvu_tuor_name"];
            $arr[]=$nhacungcap;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>