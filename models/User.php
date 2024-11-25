<?php
class User {
    private $username;
    private $password;
    private $table;

    // Constructeur
    public function __construct($username = null, $password = null) {
        $this->username = $username;
        $this->password = $password;
        $this->table = (substr($username, -6) === ".admin") ? "admin" : "visitor";
    }

    // Getters
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTable() {
        return $this->table;
    }

    // Setters
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

?>
