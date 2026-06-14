<?php
class User {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function register($username, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':username' => $username, ':password' => $hashed_password]);
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>