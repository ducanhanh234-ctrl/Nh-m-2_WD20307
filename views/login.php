<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="./views/login.css" />
  </head>
  <body>
    <div class="login-container">
      <h2>Sign In</h2>
      <?php
      if(isset($_SESSION["role"])){echo $_SESSION["role"];}
      
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
          <input type="text" placeholder="Username" name="tentk" required />
        </div>
        <div class="input-group">
          <input type="password" placeholder="Password" name="mk"required />
        </div>
        <button type="submit" class="login-btn" name="dangnhap">Login</button>
        <div class="links">
          <a href="?action=logup">Sign Up</a>
        </div>
      </form>
    </div>
  </body>
</html>
