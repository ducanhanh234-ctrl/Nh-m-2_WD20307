<?php
require_once "views/admin/layout/header.php";
?>
<div class="chart">
  <h3>Quản Lý Phiên Bản</h3>
  <div class="button-group">
    <a href="?action=phienban-insert" class="them_style_btn">Thêm Mới</a>
  </div>
</div>
<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>loaipb_name</th>
                  <th>anh_tuor_id</th>
                  <th>chinhsach_tuor_id</th>
                  <th>price</th>
                  <th>thoigian</th>
                  <th>khoihanh</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($arr_phienban as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->name?></td>
                  <td><?=$a->loaipb_name?></td>
                  <td><img src="<?= $a->anh_tuor_name?>" alt="" width="100px"></td>
                  <td><?=$a->chinhsach_tuor_name?></td>
                  <td><?= number_format($a->price)?></td>
                  <td><?=$a->thoigian?></td>
                  <td><?=$a->khoihanh?></td>
                  <td class="action">
                    <a href="?action=phienban-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=phienban-delete&id=<?=$a->id?>" class="xoa_style_btn" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
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