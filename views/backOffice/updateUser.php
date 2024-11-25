<?php
session_start();
require_once(__DIR__ . '/../../controllers/UserController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    if (isset($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'])) {
        $result = $userController->updatePassword(
            $_SESSION['username'], 
            $_POST['oldPassword'], 
            $_POST['newPassword'], 
            $_POST['confirmNewPassword']
        );

        if ($result === true) {
            $_SESSION['message'] = 'Mot de passe mis à jour.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = $result;
            $_SESSION['message_type'] = 'error';
        }
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $imageResult = $userController->updateProfilePicture($_SESSION['username'], $_FILES['profile_picture']);

        if ($imageResult === true) {
            $_SESSION['message'] = 'Photo de profil mise à jour.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = $imageResult;
            $_SESSION['message_type'] = 'error';
        }
    }

    header("Location: ../frontOffice/homeUser.php#Profile");
    exit();
}
?>
