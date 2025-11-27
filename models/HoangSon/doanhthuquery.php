<?php
class doanhthuquery extends BaseModel{
    public function all(){
        try{
        $sql = "SELECT doanhthu.* , tuor.name as tuor_name , thanhtoan.sotiendathanhtoan as thanhtoan_name
FROM doanhthu
JOIN tuor ON doanhthu.tuor_id = tuor.id
JOIN thanhtoan ON doanhthu.thanhtoan_id = thanhtoan.id";
        $data = $this->pdo->query($sql)->fetchAll();
        $arr = [];
        foreach($data as $a){
            $doanhthu = new doanhthu();
            $doanhthu->id = $a["id"];
            $doanhthu->tuor_id = $a["tuor_id"];
            $doanhthu->tuor_name = $a["tuor_name"];
            $doanhthu->thanhtoan_id = $a["thanhtoan_id"];
            $doanhthu->thanhtoan_name = $a["thanhtoan_name"];
            $arr[]=$doanhthu;
        }
        return $arr;
        }catch(Exception $e){
            echo "Lỗi<br>".$e->getMessage();
        }
        
    }
}
?>