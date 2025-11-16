<?php
require_once "header.php";
?>

<div class="chart">
            <h3>Quản Lý Danh Mục Tuor</h3>
          </div>
          <br>
          <div><a href="?action=danhmuc_insert" class="them_style_btn" style="color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 8px; /* Bo góc */
  font-size: 15px;
  transition: 0.3s;
  background-color: rgb(44, 219, 102);
  margin-top: 150px;">Thêm Mới Danh Mục</a></div>
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
                  <td>
                    <a href="?action=danhmuc_update&id=<?=$a->id?>" class="sua_style_btn">Sửa</a>
                    <a href="?action=danhmuc_delete&id=<?=$a->id?>" class="xoa_style_btn">Xóa</a>
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