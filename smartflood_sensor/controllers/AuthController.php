<?php

class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        
        require_once 'models/User.php';
        $this->userModel = new User($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php?page=sensor&action=index");
                exit();
            } else {
                $error = "Username atau password salah!";
                require_once 'views/auth/login.php';
                return;
            }
        }
        require_once 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            if ($this->userModel->register($username, $password)) {
                header("Location: index.php?page=auth&action=login&status=registered");
                exit();
            } else {
                $error = "Gagal mendaftar, mungkin username sudah digunakan.";
                require_once 'views/auth/register.php';
                return;
            }
        }
        require_once 'views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=auth&action=login");
        exit();
    }
}
?>