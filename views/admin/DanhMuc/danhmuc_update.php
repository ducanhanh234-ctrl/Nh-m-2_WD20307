<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Cập Nhật danh Mục</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <span>Nhập Tên:</span>
        <input type="text" name="name" value="<?=$arr_danhmuc->name?>"/>
      </div>
      <div>
        <span></span>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
  </body>
</html>
