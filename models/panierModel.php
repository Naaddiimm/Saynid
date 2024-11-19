<?php
require_once(__DIR__ . '/../config/config.php');

class PanierModel {
    private $pdo;

    public function __construct() {
        // Utiliser la connexion PDO du fichier config.php
        global $db;
        $this->pdo = $db;
    }

    // Méthode pour récupérer l'ID du cours à partir de son titre
    public function getCourseIdByTitle($title) {
        $stmt = $this->pdo->prepare("SELECT id_cours FROM cours WHERE titre = :title");
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $courseId = $stmt->fetchColumn();

        // Vérification de l'ID du cours
        if ($courseId) {
            echo "ID du cours trouvé : " . $courseId . "<br>";
        } else {
            echo "Cours non trouvé pour le titre : " . $title . "<br>";
        }

        return $courseId;
    }

    // Méthode pour insérer un achat dans la table p_cours
    public function addCoursePurchase($username, $courseId) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO p_cours (user, id_C, status_C) VALUES (:user, :id_C, 1)");
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':id_C', $courseId);
            $stmt->execute();

            // Si l'insertion réussit
            echo "Achat du cours ajouté à la base de données.<br>";
            return true;
        } catch (Exception $e) {
            // Afficher l'erreur SQL si l'insertion échoue
            echo "Erreur SQL : " . $e->getMessage() . "<br>";
            return false;
        }
    }
}
?>
