<?php
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../controllers/UserController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? null;
        $action = $_POST['action'] ?? null;
    
        if (!$username || !$action) {
            header("Location: userAction.php?error=invalid_request");
            exit();
        }
    
        $controller = new UserController($db);
    
        if ($action === 'block') {
            $controller->blockUser($username);
        } elseif ($action === 'unblock') {
            $controller->unblockUser($username);
        } elseif ($action === 'delete') {
            $result = $controller->deleteUser($username);
            if ($result === true) {
                header("Location: userAction.php?success=delete");
            } else {
                header("Location: userAction.php?error=$result");
            }
        }
    
        header("Location: homeAdmin.php ");
        exit();
    }
}
    

?>
