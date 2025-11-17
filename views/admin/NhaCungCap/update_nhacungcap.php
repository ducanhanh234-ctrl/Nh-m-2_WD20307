<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới nhacungcap</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Nhà Cung cấp:</span>
        <input type="text" name="ten_don_vi" value="<?=$arr_find->ten_don_vi?>"/>
      </div>
      <div>
        <span>Nhập Địa Chỉ:</span>
        <input type="text" name="diachi" value="<?=$arr_find->diachi?>"/>
      </div>
      <div>
        <span>Nhập Liên Hệ:</span>
        <input type="text" name="lienhe" value="<?=$arr_find->lienhe?>"/>
      </div>
      <div>
        <span>Nhập Năng Lực Cung cấp:</span>
        <input type="text" name="nang_luc_cung_cap" value="<?=$arr_find->nang_luc_cung_cap?>"/>
      </div>
      <div>
        <span>Nhập Dịch Vụ Nhà Cung Cấp:</span>
        <select name="dichvu_tuor_id" id="">
          <?php
          foreach($arr_dichvu as $a){
            if($a->id == $arr_find->dichvu_tuor_id){
            ?>
            <option value="<?=$a->id?>" selected><?=$a->loai_dichvu_tuor?></option>
            <?php
          }else{
            ?>
            <option value="<?=$a->id?>"><?=$a->loai_dichvu_tuor?></option>

            <?php
          }
          }
          ?>
        </select>
      </div>
      <div>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
  </body>
</html>
