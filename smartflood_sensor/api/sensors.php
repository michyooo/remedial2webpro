<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once '../config/database.php';
require_once '../models/Sensor.php';

$database = new Database();
$db = $database->getConnection();
$sensorModel = new Sensor($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $sensorModel->getAll();
    http_response_code(200);
    echo json_encode(["status" => "success", "timestamp" => date('Y-m-d H:i:s'), "data" => $data]);
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
}
?>