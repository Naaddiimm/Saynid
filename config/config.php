<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'saynid');
define('DB_USER', 'root');
define('DB_PASS', '');

class config {
    private static $db;

    // Connexion à la base de données
    public static function getConnexion() {
        if (self::$db == null) {
            try {
                self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$db;
    }
}
?>
