<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới Kế Hoạch Khởi Hành</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Phiên Bản:</span>
        <select name="phienban_id" id="">
            <?php
            foreach($arr_phienban as $a){
              ?>
              <option value="<?=$a->id?>"><?=$a->name?></option>
              <?php
            }
            ?>
        </select>
      </div>
     <div>
        <span>Chọn Lịch Trình:</span>
        <select name="lichtrinh_id" id="">
            <?php
            foreach($arr_lichtrinh as $a){
              ?>
              <option value="<?=$a->id?>"><?=$a->ngay?></option>
              <?php
            }
            ?>
        </select>
      </div>
     <div>
        <span>Chọn Nhân Sự:</span>
        <select name="nhansu_id" id="">
            <?php
            foreach($arr_nhansu as $a){
              ?>
              <option value="<?=$a['id']?>"><?=$a['name']?></option>
              <?php
            }
            ?>
        </select>
      </div>
      <div>
        <span>Nhập Điểm Tập Trung:</span>
        <input type="text" name="diemtaptrung" />
      </div>
      <div>
        <span></span>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
  </body>
</html>
