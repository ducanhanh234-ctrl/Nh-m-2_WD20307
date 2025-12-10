<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  </head>
  <body>
    <h1>Thêm Mới Lịch Trình</h1>
    <a href="?action=lichtrinh-list" class="btn btn-outline-primary mb-3"> <i class="bi bi-arrow-left"></i> Trang Chủ</a>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <span>Nhập Tuor:</span>
            <select name="tuor_id" id="">
                <?php
                foreach($arr_tuor as $a){
                  if($a->id == $_GET["tuor_id"]){
                    ?>
                <option value="<?=$a->id?>" selected><?=$a->name?></option>
                    <?php
                }else{
                  ?>
                <option value="<?=$a->id?>"><?=$a->name?></option>

                  <?php
                }
                }
                ?>
            </select>
        </div>
      <div>
        <span>Nhập ngày:</span>
        <select name="ngay" id="">
          <?php
          for($i = 1; $i<= $_SESSION["songay"]; $i++){
            ?>
            <option value="<?=$i?>">Ngày <?=$i?></option>
            <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Giờ:</span>
        <input type="time" name="gio"/>
      </div>
      <div>
        <span>Nhập Địa Điểm:</span>
        <input type="text" name="diadiem" />
      </div>
      <div>
        <span>Nhập Hoạt Động Cụ Thể:</span>
        <input type="text" name="hoatdongcuthe" />
      </div>
      <div>
        <span></span>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
