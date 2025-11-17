<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/cssCRUD.css" />
  </head>
  <body>
    <h1>Cập Nhật Tuor</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên Tuor:</span>
        <input type="text" name="name" value="<?=$arr_find->name?>"/>
      </div>
      <div>
        <span>Nhập danh mục tuor:</span>
        <select name="danhmuc_id" id="">
          <?php
          foreach($arr_danhmuc as $a){
            if($a->id == $arr_find->danhmuc_id){
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
        <span>Nhập Mô Tả:</span>
        <input type="text" name="mota" value="<?=$arr_find->mota?>"/>
      </div>
      
      <div>
        <span>Nhập Phiên BẢn:</span>
        <select name="phienban_id" id="">
          <?php
          foreach($arr_phienban as $e){
            if($e->id == $arr_find->phienban_id){
            ?>
            <option value="<?=$e->id?>" selected><?=$e->name?></option>
            <?php
          }else{
            ?>
            <option value="<?=$e->id?>"><?=$e->name?></option>

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
