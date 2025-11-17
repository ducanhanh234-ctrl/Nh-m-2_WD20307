<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới Phiên Bản</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Phiên Bản:</span>
        <input type="text" name="name" />
      </div>
      <div>
        <span>Nhập Loại Phiên Bản:</span>
        <select name="loaipb_id" id="">
          <?php
          foreach($arr_loaipb as $a){
            ?>
          <option value="<?=$a->id?>"><?=$a->name?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Ảnh:</span>
        <select name="anh_tuor_id" id="">
          <?php
          foreach($arr_anhtuor as $b){
            ?>
          <option value="<?=$b->id?>"><?=$b->img_main?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Chính Sách:</span>
        <select name="chinhsach_tuor_id" id="">
          <?php
          foreach($arr_chinhsach as $c){
            ?>
          <option value="<?=$c->id?>"><?=$c->name?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Nhà Cung Cấp:</span>
        <select name="nhacungcap_id" id="">
          <?php
          foreach($arr_nhacungcap as $d){
            ?>
          <option value="<?=$d->id?>"><?=$d->ten_don_vi?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Giá:</span>
        <input type="text" name="price" />
      </div>
      <div>
        <span>Nhập Thời Gian:</span>
        <input type="text" name="thoigian" />
      </div>
      <div>
        <span>Nhập phương tiện:</span>
        <input type="text" name="phuongtien" />
      </div>
      <div>
        <span>Nhập Khởi Hành:</span>
        <input type="text" name="khoihanh" />
      </div>
      <div>
        <span>Nhập Khách Sạn:</span>
        <select name="khachsan_id" id="">
          <?php
          foreach($arr_khachsan as $e){
            ?>
          <option value="<?=$e->id?>"><?=$e->ten_ks?></option>
          <?php
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
