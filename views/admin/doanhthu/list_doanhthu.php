<?php
require_once "views/admin/layout/header.php";
?>


<div class="chart">


  <h3>Quản Lý Doanh Thu </h3>
  

</div>


<div class="table_qlpbt">
  <table class="styled-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>tuor_name</th>
                  <th>thanhtoan_name</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($arr as $a){
                    ?>
                    <tr>
                  <td><?=$a->id?></td>
                  <td><?=$a->tuor_name?></td>
                  <td><?=number_format($a->thanhtoan_name)?> VND</td>
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