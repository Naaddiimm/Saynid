<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../config/config.php');

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    // Méthode pour inscrire un utilisateur
    public function signUp($username, $password, $confirmPassword) {
        return $this->user->register($username, $password, $confirmPassword);
    }

    // Méthode pour connecter un utilisateur
    public function signIn($username, $password) {
        return $this->user->login($username, $password);
    }

    // Méthode pour obtenir les visiteurs
    public function getVisitors() {
        return $this->user->getVisitors();
    }

    public function blockUser($username) {
        return $this->user->toggleBlockUser($username, 0); // Bloquer l'utilisateur
    }
    
    public function unblockUser($username) {
        return $this->user->toggleBlockUser($username, 1); // Débloquer l'utilisateur
    }

    public function deleteUser($username) {
        // Empêcher la suppression de l'admin actuel
        if ($_SESSION['username'] === $username) {
            return "Vous ne pouvez pas supprimer votre propre compte.";
        }

        // Empêcher la suppression d'un administrateur
        if (substr($username, -6) === ".admin") {
            return "Vous ne pouvez pas supprimer un compte administrateur.";
        }

        // Appeler la méthode de suppression
        return $this->user->deleteUser($username);
    }
}
?>
