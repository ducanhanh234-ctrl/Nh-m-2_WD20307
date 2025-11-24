<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Cập Nhật Kế Hoạch Khởi Hành</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Phiên Bản:</span>
        <select name="phienban_id" id="">
            <?php
            foreach($arr_phienban as $a){
                if($a->id==$arr_kehoachkh->phienban_id){
              ?>
              <option value="<?=$a->id?>" selected ><?=$a->name?></option>
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
        <span>Chọn Lịch Trình:</span>
        <select name="lichtrinh_id" id="">
            <?php
            foreach($arr_lichtrinh as $a){
                if($a->id==$arr_kehoachkh->lichtrinh_id){
              ?>
              <option value="<?=$a->id?>" selected ><?=$a->ngay?></option>
              <?php
            }else{
                ?>
                <option value="<?=$a->id?>"><?=$a->ngay?></option>
                <?php
            }
            }
            ?>
        </select>
      </div>
     <div>
        <span>Chọn Nhân Sự:</span>
        <select name="nhansu_id" id="">
            <?php
            foreach($arr_nhansu as $a){
                if($a['id']==$arr_kehoachkh->nhansu_id){
              ?>
              <option value="<?=$a['id']?>" selected ><?=$a['name']?></option>
              <?php
            }else{
                ?>
                <option value="<?=$a['id']?>"><?=$a['name']?></option>
                <?php
            }
            }
            ?>
        </select>
      </div>
      <div>
        <span>Nhập Điểm Tập Trung:</span>
        <input type="text" name="diemtaptrung" value="<?=$arr_kehoachkh->diemtaptrung?>"/>
      </div>
      <div>
        <span></span>
        <button type="submit" name="nut">Cập Nhật</button>
      </div>
    </form>
  </body>
</html>
