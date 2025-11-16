<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới Tuor</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Tuor:</span>
        <input type="text" name="name" />
      </div>
      <div>
        <span>Nhập danh mục tuor:</span>
        <select name="danhmuc_id" id="">
          <?php
          foreach($arr_danhmuc as $a){
            ?>
            <option value="<?=$a->id?>"><?=$a->name?></option>
            <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Mô Tả:</span>
        <input type="text" name="mota" />
      </div>
      
      <div>
        <span>Nhập Phiên BẢn:</span>
        <select name="phienban_id" id="">
          <?php
          foreach($arr_phienban as $e){
            ?>
            <option value="<?=$e->id?>"><?=$e->name?></option>
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
