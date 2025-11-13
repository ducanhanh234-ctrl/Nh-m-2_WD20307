<?php
require_once "header.php";
?>
<div class="chart">
<h3>Quản Lý Phiên Bản</h3>
</div>
<div class="table_qlpbt">
  <a href="?action=phienban-insert" class="sua_style_btn">Thêm Mới</a>
            <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>loaipb_name</th>
                  <th>anh_tuor_id</th>
                  <th>chinhsach_tuor_id</th>
                  <th>nhacungcap_id</th>
                  <th>price</th>
                  <th>thoigian</th>
                  <th>phuongtien</th>
                  <th>khoihanh</th>
                  <th>khachsan_id</th>
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
                  <td><img src="<?= $a->anh_tuor_name?>" alt="" wifth="100px"></td>
                  <td><?=$a->chinhsach_tuor_name?></td>
                  <td><?=$a->nhacungcap_name?></td>
                  <td><?=$a->price?></td>
                  <td><?=$a->thoigian?></td>
                  <td><?=$a->phuongtien?></td>
                  <td><?=$a->khoihanh?></td>
                  <td><?=$a->khachsan_name?></td>
                  <td>
                    <a href="?action=phienban-update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=phienban-delete&id=<?=$a->id?>" class="xoa_style_btn" style="margin-top:20px;" onclick="return confirm('Bạn có chắc muốn xóa ko')">Xóa</a>
                  </td>
                </tr>
                    <?php
                }
                ?>
                
              </tbody>
            </table>
          </div>
<?php
require_once "footer.php";
?>