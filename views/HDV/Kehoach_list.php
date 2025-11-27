<?php
require_once "views/HDV/layout/header.php";
?>
  <h3>Lich Làm Việc Của HDV</h3>
  

<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>tên phiên bản</th>
                  <th>tên tuor</th>
                  <th>Ngày</th>
                  <th>Địa Điểm Tham Quan</th>
                  <th>Hoạt Động Cụ Thể</th>
                  <th>nhân sự</th>
                  <th>điểm tập chung</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr_kehoachkh as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->phienban_name?></td>
                  <td><?=$a->tuor_name?></td>
                  <td><?=$a->lichtrinh_name?></td>
                  <td><?=$a->lichtrinh_diadiem?></td>
                  <td><?=$a->lichtrinh_hoatdong?></td>
                  <td><?=$a->nhansu_name?></td>
                  <td><?=$a->diemtaptrung?></td>
                  
                </tr>
                    <?php
                }
                ?>
                
              </tbody>
            </table>
          </div>
<?php
require_once "views/admin/layout/footer.php";
?>