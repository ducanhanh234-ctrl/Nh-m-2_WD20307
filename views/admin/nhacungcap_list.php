<?php
require_once "header.php";
?>

<div class="chart">
            <h3>Quản Lý nhà Cung cấp</h3>
          </div>
          <div><a href="?action=nhacungcap-insert" class="them_style_btn" style="color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 8px; /* Bo góc */
  font-size: 15px;
  transition: 0.3s;
  background-color: rgb(44, 219, 102);
  margin-top: 150px;">Thêm Mới Nhà Cung Cấp</a></div>
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
                  <td>
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
require_once "footer.php";
?>