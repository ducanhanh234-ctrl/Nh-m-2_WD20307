<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/cssCRUD.css" />
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
        <select name="phienban_id" id="phienban_id">
          <option value="" selected>Chọn Phiên Bản Tuor</option>
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
        <span>Giá:</span>
        <input type="text" id="phienban_price" />
      </div>
      <div>
        <span>Thời Gian:</span>
        <input type="text" id="phienban_thoigian" />
      </div>
      <div>
        <span>Phương Tiện:</span>
        <input type="text" id="phienban_phuongtien" />
      </div>
      <div>
        <span>Khởi Hành:</span>
        <input type="text" id="phienban_khoihanh" />
      </div>
      <div>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
    <script>
    const selectPhienBan = document.getElementById("phienban_id");
    const arr_phienban = <?= json_encode($arr_phienban) ?>;
    selectPhienBan.addEventListener("change", function () {
        const id = this.value; 
        const pb = arr_phienban.find(item => item.id == id);
        if (pb) {
            document.getElementById("phienban_price").value = pb.price;
            document.getElementById("phienban_thoigian").value = pb.thoigian;
            document.getElementById("phienban_phuongtien").value = pb.phuongtien;
            document.getElementById("phienban_khoihanh").value = pb.khoihanh;
        } else {
            document.getElementById("phienban_price").value = "";
            document.getElementById("phienban_thoigian").value = "";
            document.getElementById("phienban_phuongtien").value = "";
            document.getElementById("phienban_khoihanh").value = "";
        }
    });
</script>

  </body>
</html>