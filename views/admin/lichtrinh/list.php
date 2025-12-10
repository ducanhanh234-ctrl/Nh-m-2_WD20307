<?php
require_once "views/admin/layout/header.php";
?>


<div class="chart">


  <h3>Quản Lý Lịch Trình</h3>
  <div class="button-group">
    <a href="?action=lichtrinh-insert" class="them_style_btn">Thêm Mới Lịch Trình</a>
  </div>

</div>


<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>tuor_name</th>
                  <th>ngay</th>
                  <th>gio</th>
                  <th>diadiem</th>
                  <th>hoatdongcuthe</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->tuor_name?></td>
                  <td><?=$a->ngay?></td>
                  <td><?=$a->gio?></td>
                  <td><?=$a->diadiem?></td>
                  <td><?=$a->hoatdongcuthe?></td>
                  <td class="action">
                    <a href="?action=lichtrinh-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=lichtrinh-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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