<?php
session_start();
require_once(__DIR__ . '/../../controllers/UserController.php');

// Connexion à la base de données
$userController = new UserController();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if ($action === 'signup') {
        $result = $userController->signUp($username, $password, $confirmPassword);
        if ($result !== true) {
            $error = $result;
        } else {
            header("Location: index.php?action=signin");
            exit();
        }
    } elseif ($action === 'signin') {
        $result = $userController->signIn($username, $password);
        if ($result === true) {
            $_SESSION['username'] = $username;
            $redirect = (substr($username, -6) === '.admin') ? '../backOffice/homeAdmin.php' : 'homeUser.php';
            header("Location: $redirect");
            exit();
        } else {
            $error = $result;
        }
    }
}

require_once '../frontOffice/login.php';
?>
