<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="./views/login.css" />
  </head>
  <body>
    <div class="login-container">
      <h2>Sign Up</h2>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
          <input type="text" placeholder="Username" name="tentk"required />
        </div>
        <div class="input-group">
          <input type="password" placeholder="Password" name="mk"required />
        </div>
        <div class="input-group">
          <span>Nhập Tên:</span>
          <select name="nhansu_id" id="nhansu_id">
            <?php
            foreach($arr_nhansu as $a){
              ?>
              <option value="<?=$a['id']?>"><?=$a['name']?></option>
              <?php

            }
            ?>
          </select>
        </div>
        <div class="input-group">
          <span>Ngày Sinh:</span>
          <input type="text" name="nhansu_ngaysinh" id="nhansu_ngaysinh" disabled>
        </div>
        <div class="input-group">
          <span>SĐT:</span>
          <input type="text" name="nhansu_sdt" id="nhansu_sdt" disabled>
        </div>
        <div class="input-group">
          <span>Email:</span>
          <input type="text" name="nhansu_email" id="nhansu_email" disabled>
        </div>
        <button type="submit" class="login-btn" name="nut">Logup</button>
      </form>
    </div>
    <script>
    const selectNhanSu = document.getElementById("nhansu_id");
    const arr_nhansu = <?= json_encode($arr_nhansu) ?>;
    selectNhanSu.addEventListener("change", function () {
        const id = this.value; 
        const nhansu = arr_nhansu.find(item => item.id == id);
        if (nhansu) {
            document.getElementById("nhansu_ngaysinh").value = nhansu.ngaysinh;
            document.getElementById("nhansu_sdt").value = nhansu.sdt;
            document.getElementById("nhansu_email").value = nhansu.email;
            
        } else {
            document.getElementById("nhansu_ngaysinh").value = "";
            document.getElementById("nhansu_sdt").value = "";
            document.getElementById("nhansu_email").value = "";
            
        }
    });
    window.addEventListener("DOMContentLoaded", () => {
    nhansu_id.dispatchEvent(new Event("change"));
  });
</script>
  </body>
</html>
