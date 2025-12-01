<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới Lịch Trình</h1>
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
        <input type="text" name="ngay" value="<?=$lichtrinh->ngay?>"/>
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
</html>
