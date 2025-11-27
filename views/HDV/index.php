<?php
require_once 'layout/header.php';
?>
<?php
if(isset($_SESSION["name"])){
    if($_SESSION["role"] == "ADMIN"){
        echo "<h1 style='test-align: center;'>Xin Chào ADMIN ".$_SESSION["name"]."</h1>";
    }else{
        echo "<h1 style='test-align: center;'>Xin Chào HDV ".$_SESSION["name"]."</h1>";
    }
}
?>
<?php
require_once 'layout/footer.php';
?>