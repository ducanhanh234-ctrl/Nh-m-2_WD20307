<?php
require_once "views/admin/layout/header.php";
?>

<div class="chart">


  <h3>Quản Lý Giá</h3>
  <div class="button-group">
    <a href="?action=gia-insert" class="them_style_btn">Thêm Mới Giá</a>
  </div>
</div>

<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>phienban_name</th>
                  <th>doituong_name</th>
                  <th>thoidiem_name</th>
                  <th>dvkemtheo_name</th>
                  <th>tong_gia</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr_giasaucung as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->phienban_name?></td>
                  <td><?=$a->doituong_name?></td>
                  <td><?=$a->thoidiem_name?></td>
                  <td><?=$a->dvkemtheo_name?></td>
                  <td><?= number_format($a->tong_gia)?> VND</td>
                  <td class="action">
                    <a href="?action=gia-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=gia-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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