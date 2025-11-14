<?php 

class TourModel extends BaseModel {
    public function GetAllTour() {
        $sql = "SELECT * FROM `tuor`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


}