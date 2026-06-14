<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/sensorController.php';

if (!isset($_SESSION['user_id']) && (!isset($_GET['page']) || $_GET['page'] !== 'auth' || $_GET['action'] === 'index')) {
    $page = 'auth';
    $action = 'login';
} else {
    $page = isset($_GET['page']) ? $_GET['page'] : 'sensor';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
}

switch ($page) {
    case 'auth':
        $controller = new AuthController();
        if ($action == 'login') $controller->login();
        if ($action == 'register') $controller->register();
        if ($action == 'logout') $controller->logout();
        break;
    case 'sensor':
        $controller = new SensorController();
        if ($action == 'index') $controller->index();
        if ($action == 'create') $controller->create();
        if ($action == 'edit') $controller->edit();
        if ($action == 'delete') $controller->delete();
        break;
    default:
        header("Location: index.php?page=auth&action=login");
        exit();
}
?>