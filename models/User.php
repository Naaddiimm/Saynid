<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifie si un utilisateur existe dans la base de données
    public function userExists($username) {
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        $query = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE username = :username");
        $query->execute(['username' => $username]);
        return $query->fetchColumn() > 0;
    }

    // Inscription de l'utilisateur
    public function register($username, $password, $confirmPassword) {
        if (strlen($username) < 3 || strlen($username) > 20) {
            return "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
        }
        if ($password !== $confirmPassword) {
            return "Les mots de passe ne correspondent pas !";
        }
        if ($this->userExists($username)) {
            return "Nom d'utilisateur déjà pris !";
        }

        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        $query = $this->db->prepare("INSERT INTO $table (username, password) VALUES (:username, :password)");
        $query->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
        return true;
    }

    // Connexion de l'utilisateur
    public function login($username, $password) {
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
        $query = $this->db->prepare("SELECT * FROM $table WHERE username = :username");
        $query->execute(['username' => $username]);
        $user = $query->fetch();

        // Vérifier si l'utilisateur existe
        if ($user) {
            // Si l'utilisateur est un "visitor", vérifier le statut "active"
            if ($table === "visitor" && $user['active'] == 0) {
                return "Votre compte est bloqué. Veuillez contacter l'administrateur.";
            }
            // Vérifier le mot de passe
            if (password_verify($password, $user['password'])) {
                return true; // Connexion réussie
            }
        }
        return "Nom d'utilisateur ou mot de passe incorrect !"; // Erreur de connexion
    }

    // Récupère les visiteurs
    public function getVisitors() {
        $query = $this->db->prepare("SELECT username, active FROM visitor");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleBlockUser($username, $block) {
        $query = $this->db->prepare("UPDATE visitor SET active = :block WHERE username = :username");
        $query->execute(['block' => $block, 'username' => $username]);
        return $query->rowCount() > 0; // Retourne true si la mise à jour a réussi
    }

    public function deleteUser($username) {
        // Vérifier si l'utilisateur est un admin ou un visitor
        $table = (substr($username, -6) === ".admin") ? "admin" : "visitor";

        try {
            $query = $this->db->prepare("DELETE FROM $table WHERE username = :username");
            $query->execute(['username' => $username]);
            return $query->rowCount() > 0; // Retourne true si la suppression a réussi
        } catch (PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }
}
?>
