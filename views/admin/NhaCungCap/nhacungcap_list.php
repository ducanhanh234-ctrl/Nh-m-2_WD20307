<?php
require_once "views/admin/layout/header.php";
?>

<div class="chart">
  <h3>Quản Lý nhà Cung cấp</h3>
  <div class="button-group">
    <a href="?action=nhacungcap-insert" class="them_style_btn">Thêm Mới Nhà Cung Cấp</a>
  </div>
</div>
<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>ten_don_vi</th>
                  <th>diachi</th>
                  <th>lienhe</th>
                  <th>nang_luc_cung_cap</th>
                  <th>dichvu_tuor_name</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr_nhacungcap as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->ten_don_vi?></td>
                  <td><?=$a->diachi?></td>
                  <td><?=$a->lienhe?></td>
                  <td><?=$a->nang_luc_cung_cap?></td>
                  <td><?=$a->dichvu_tuor_name?></td>
                  <td class="action">
                    <a href="?action=nhacungcap-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=nhacungcap-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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