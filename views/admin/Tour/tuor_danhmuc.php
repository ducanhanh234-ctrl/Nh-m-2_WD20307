<?php
require_once "views/admin/layout/header.php";
?>


<div class="chart">


  <h3>Quản Lý Danh Mục Tuor</h3>
  <div class="button-group">
    <a href="?action=danhmuc_insert" class="them_style_btn">Thêm Mới Danh Mục</a>
  </div>

</div>


<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr_danhmuc as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->name?></td>
                  <td class="action">
                    <a href="?action=danhmuc_update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=danhmuc_delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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