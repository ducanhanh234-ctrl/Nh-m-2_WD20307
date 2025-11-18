<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="views/admin/assets/style/LayoutCSS/cssCRUD.css" />
  </head>
  <body>
    <h1>Thêm Mới giá</h1>
    <form action="" method="post" enctype="multipart/form-data">
      
      <div>
        <span>Nhập Loại Phiên Bản:</span>
        <select name="phienban_id" id="phienban_id">
            <option value="" selected>CHọn Phiên bản</option>
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
        <span>Nhập Đối Tượng:</span>
        <select name="doituong_id" id="doituong_id">
            <option value="" selected>CHọn Đối Tượng</option>
          <?php
          foreach($arr_doituong as $b){
            ?>
          <option value="<?=$b->id?>"><?=$b->loai_doituong?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập Thời Điểm:</span>
        <select name="thoidiem_id" id="thoidiem_id">
            <option value="" selected>CHọn Thời Điểm</option>
          <?php
          foreach($arr_thoidiem as $c){
            ?>
          <option value="<?=$c->id?>"><?=$c->loai_thoidiem?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Nhập dịch vụ kèm theo:</span>
        <select name="dvkemtheo_id" id="dvkemtheo_id">
            <option value="" selected>CHọn Dịch vụ kèm theo</option>
          <?php
          foreach($arr_dichvu as $d){
            ?>
          <option value="<?=$d->id?>"><?=$d->loai_dichvu?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <span>Tổng Giá:</span>
        <input type="text" name="tong_gia" id="tong" readonly/>
      </div>
      <div>
        <button type="submit" name="nut">OK</button>
      </div>
    </form>
    <script>
  const selectPhienBan = document.getElementById("phienban_id");
  const arrPhienBan = <?= json_encode($arr_phienban) ?>;

  const selectDoituong = document.getElementById("doituong_id");
  const arrDoituong = <?= json_encode($arr_doituong) ?>;

  const selectThoidiem = document.getElementById("thoidiem_id");
  const arrThoidiem = <?= json_encode($arr_thoidiem) ?>;

  const selectDichvu = document.getElementById("dvkemtheo_id");
  const arrDichvu = <?= json_encode($arr_dichvu) ?>;

  const tongGiaInput = document.querySelector('input[name="tong_gia"]');

  function layGia(item) {
      if (!item) return 0;
      if (item.tang !== null && item.tang !== undefined && item.tang !== "") {
          return Number(item.tang); 
      }
      if (item.giam !== null && item.giam !== undefined && item.giam !== "") {
          return Number(item.giam) * -1; 
      }
      if(item.price){
        return Number(item.price);
      }
      return 0;
  }

  function tinhTong() {
      let tong = 0;

      let pb = arrPhienBan.find(i => i.id == selectPhienBan.value);
      tong += layGia(pb);

      let dt = arrDoituong.find(i => i.id == selectDoituong.value);
      tong += layGia(dt);

      let td = arrThoidiem.find(i => i.id == selectThoidiem.value);
      tong += layGia(td);

      let dv = arrDichvu.find(i => i.id == selectDichvu.value);
      tong += layGia(dv);

      tongGiaInput.value = tong;
  }
  [selectPhienBan, selectDoituong, selectThoidiem, selectDichvu].forEach(s => {
      s.addEventListener("change", tinhTong);
  });
</script>
  </body>
</html>
