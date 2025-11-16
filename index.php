<?php 

session_start();

spl_autoload_register(function ($class) {    
    $fileName = "$class.php";

    $fileModel = findInFolder(PATH_MODEL, $fileName);
    $fileController = findInFolder(PATH_CONTROLLER, $fileName);

    if (is_readable($fileModel)) {
        require_once $fileModel;
    } 
    else if (is_readable($fileController)) {
        require_once $fileController;
    }
});
function findInFolder($baseDir, $fileName)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));
    foreach ($iterator as $file) {
        if ($file->getFilename() === $fileName) {
            return $file->getPathname();
        }
    }
    return false;
}

require_once './configs/env.php';
require_once './configs/helper.php';


// Điều hướng

require_once './routes/index.php';







?>
