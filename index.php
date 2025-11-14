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
// require_once './routes/index.php';

require_once './controllers/Huy/QHController.php';

$controller = new QHController();
$action = $_GET['action'] ?? 'listUsers';
$id = $_GET['id'] ?? null;

switch($action) {
    case 'listUsers':
        $controller->listUsers();
        break;
    case 'createUsers':
        $controller->createUsers();
        break;
    case 'storeUsers':
        $controller->storeUsers();
        break;
    case 'editUsers':
        if ($id) $controller->editUsers($id);
        break;
    case 'updateUsers':
        if ($id) $controller->updateUsers($id);
        break;
    case 'deleteUsers':
        if ($id) $controller->deleteUsers($id);
        break;
    default:
        $controller->listUsers();
        break;
}





?>
