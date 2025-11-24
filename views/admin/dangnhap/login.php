<?php
require_once "views/admin/layout/header.php";
?>
<div class="chart">
<h3>Quản Lý Đăng Nhập</h3>
</div>
<div class="table_qlpbt">
            <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>nhansu_name</th>
                  <th>role</th>
                  <th>tentk</th>
                  <th>mk</th>
                  <th>nhansu_ngaysinh</th>
                  <th>nhansu_sdt</th>
                  <th>nhansu_email</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($arr as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->nhansu_name?></td>
                  <td><?=$a->role?></td>
                  <td><?=$a->tentk?></td>
                  <td><?=$a->mk?></td>
                  <td><?=$a->nhansu_ngaysinh?></td>
                  <td><?=$a->nhansu_sdt?></td>
                  <td><?=$a->nhansu_email?></td>
                
                  <td>
                    <a href="?action=login-update&id=<?=$a->id?>" class="sua_style_btn">Phân Quyền</a>
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