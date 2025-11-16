<?php
require_once "views/admin/layout/header.php";
?>
<div class="chart">
  <h3>Quản Lý Tuor</h3>
  <div class="button-group">
    <a href="?action=tuor-insert" class="them_style_btn">Thêm Mới</a>
  </div>
</div>
<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>danhmuc_id</th>
                  <th>mota</th>
                  <th>phienban_id</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($arr_tuor as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->name?></td>
                  <td><?=$a->danhmuc_name?></td>
                  <td><?=$a->mota?></td>
                  <td><?=$a->phienban_name?></td>
                 
                  <td class="action">
                    <a href="?action=tuor-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=tuor-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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