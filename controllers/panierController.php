<?php
session_start();
require_once(__DIR__ . '/../models/panierModel.php');

class PanierController {
    private $model;

    public function __construct() {
        $this->model = new PanierModel();
    }

    // Méthode pour traiter l'achat d'un cours
    public function handlePurchase() {
        // Vérification si les données sont bien envoyées via POST
        if (isset($_POST['courseTitle']) && isset($_SESSION['username'])) {
            $courseTitle = $_POST['courseTitle'];
            $username = $_SESSION['username'];

            // Afficher les données reçues pour débogage
            echo "Données reçues: Cours: $courseTitle, Utilisateur: $username<br>";

            // Récupérer l'ID du cours
            $courseId = $this->model->getCourseIdByTitle($courseTitle);
            if ($courseId) {
                // Insérer l'achat dans p_cours
                if ($this->model->addCoursePurchase($username, $courseId)) {
                    echo "Achat du cours réussi !";
                } else {
                    echo "Erreur lors de l'achat du cours.";
                }
            } else {
                echo "Cours non trouvé pour le titre : $courseTitle";
            }
        } else {
            echo "Données invalides : CourseTitle ou username non définis.";
        }
    }
}

// Instancier le contrôleur et traiter la soumission
$controller = new PanierController();
$controller->handlePurchase();
?>
