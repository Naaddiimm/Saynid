<?php   
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/User.php');

class UserController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    public function updateProfilePicture($username, $image) {
        $targetDir = __DIR__ . '/../uploads/profiles/';
        $targetFile = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (getimagesize($image['tmp_name']) === false) {
            return "Ce n'est pas une image valide.";
        }

        if ($image['size'] > 2000000) {
            return "L'image est trop grande. La taille maximale est de 2 Mo.";
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            return "Seuls les formats JPG, JPEG, PNG et GIF sont autorisés.";
        }

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $sql = "UPDATE visitor SET profile_picture = :profile_picture WHERE username = :username";
            $query = $this->db->prepare($sql);
            $query->execute(['profile_picture' => basename($image['name']), 'username' => $username]);
            return true;
        }

        return "Erreur lors de l'upload de l'image.";
    }

    public function getProfilePicture($username) {
        $sql = "SELECT profile_picture FROM visitor WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute(['username' => $username]);
        $result = $query->fetch();
        return $result['profile_picture'] ?? 'default-profile.png';
    }

    public function signUp($username, $password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            return "Les mots de passe ne correspondent pas !";
        }

        $user = new User($username, $password);
        return $this->registerUser($user);
    }

    private function registerUser(User $user) {
        if (strlen($user->getUsername()) < 3 || strlen($user->getUsername()) > 20) {
            return "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
        }

        if ($this->userExists($user)) {
            return "Nom d'utilisateur déjà pris !";
        }

        $sql = "INSERT INTO " . $user->getTable() . " (username, password) VALUES (:username, :password)";
        $query = $this->db->prepare($sql);
        $query->execute(['username' => $user->getUsername(), 'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT)]);
        return true;
    }

    private function userExists(User $user) {
        $sql = "SELECT COUNT(*) FROM " . $user->getTable() . " WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute(['username' => $user->getUsername()]);
        return $query->fetchColumn() > 0;
    }

    public function signIn($username, $password) {
        $user = new User($username, $password);
        return $this->loginUser($user);
    }

    private function loginUser(User $user) {
        // Déterminer si l'utilisateur est un admin ou un visitor
        if (str_ends_with($user->getUsername(), '.admin')) {
            $tableName = 'admin'; // Utilisateur admin
        } else {
            $tableName = 'visitor'; // Utilisateur visitor
        }
    
        // Requête pour récupérer les données utilisateur
        $sql = "SELECT * FROM $tableName WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute(['username' => $user->getUsername()]);
        $userData = $query->fetch();
    
        if (!$userData) {
            return "Nom d'utilisateur ou mot de passe incorrect !";
        }
    
        // Si l'utilisateur est un visitor, vérifier le statut de blocage
        if ($tableName === 'visitor' && isset($userData['active']) && $userData['active'] == 0) {
            return '<span>Votre compte est bloqué ! <a href="#contact-admin.php" style="color: black; text-decoration: underline;">Contactez l\'administrateur</a></span>';
        }
    
        // Vérification du mot de passe
        if (password_verify($user->getPassword(), $userData['password'])) {
            return true; // Connexion réussie
        }
    
        return "Nom d'utilisateur ou mot de passe incorrect !";
    }
    
    
    

    public function updatePassword($username, $oldPassword, $newPassword, $confirmNewPassword) {
        if ($newPassword !== $confirmNewPassword) {
            return "Les nouveaux mots de passe ne correspondent pas !";
        }

        if (strlen($newPassword) < 6) {
            return "Le mot de passe doit contenir au moins 6 caractères.";
        }

        $sql = "SELECT * FROM visitor WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute(['username' => $username]);
        $userData = $query->fetch();

        if (!$userData) {
            return "Utilisateur non trouvé.";
        }

        if (!password_verify($oldPassword, $userData['password'])) {
            return "Ancien mot de passe incorrect.";
        }

        $sql = "UPDATE visitor SET password = :newPassword WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute([
            'newPassword' => password_hash($newPassword, PASSWORD_BCRYPT),
            'username' => $username
        ]);

        return true; 
    }
    
    public function deleteUser($username) {
        // Supprimer les lignes dans p_cours
        $query = "DELETE FROM p_cours WHERE user = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Supprimer l'utilisateur de la table visitor
        $query = "DELETE FROM visitor WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Erreur de suppression: ' . $e->getMessage();
        }
    }

    public function getVisitors() {
        $sql = "SELECT username, active FROM visitor";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

       // Bloquer un utilisateur
       public function blockUser($username) {
        $user = new User($username);
        return $this->toggleBlockUser($user, 0); // Bloquer l'utilisateur
    }

    // Débloquer un utilisateur
    public function unblockUser($username) {
        $user = new User($username);
        return $this->toggleBlockUser($user, 1); // Débloquer l'utilisateur
    }

    // Modifier l'état de blocage d'un utilisateur
    private function toggleBlockUser(User $user, $block) {
        $sql = "UPDATE " . $user->getTable() . " SET active = :block WHERE username = :username";
        $query = $this->db->prepare($sql);
        $query->execute(['block' => $block, 'username' => $user->getUsername()]);
        return $query->rowCount() > 0;
    }


    public function countActiveUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM visitor WHERE active = 1");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countInactiveUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM visitor WHERE active = 0");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
?>