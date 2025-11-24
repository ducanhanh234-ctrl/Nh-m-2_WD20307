<?php
require_once "views/admin/layout/header.php";
?>
  <h3>Quản Lý Kế Hoạch Khởi Hành</h3>
  <div class="button-group">
    <a href="?action=kehoachkh-insert" class="them_style_btn">Thêm Mới Kế Hoạch Khởi Hành</a>
  </div>

<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>tên phiên bản</th>
                  <th>lịch trình</th>
                  <th>nhân sự</th>
                  <th>điểm tập chung</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr_kehoachkh as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->phienban_name?></td>
                  <td><?=$a->lichtrinh_name?></td>
                  <td><?=$a->nhansu_name?></td>
                  <td><?=$a->diemtaptrung?></td>
                  <td class="action">
                    <a href="?action=kehoachkh-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=kehoachkh-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
                  </td>
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