<?php
function uploadPhoto($file) {
    if (!isset($file) || empty($file['name'])) return ['status' => true, 'path' => null];
    
    $targetDir = "uploads/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if (!in_array($fileType, ['jpg', 'png', 'jpeg'])) return ['status' => false, 'msg' => 'Hanya JPG/PNG.'];
    if ($file["size"] > 2000000) return ['status' => false, 'msg' => 'Maks 2MB.'];
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) return ['status' => true, 'path' => $targetFilePath];
    
    return ['status' => false, 'msg' => 'Gagal upload.'];
}

function determineStatus($level) {
    if ($level >= 100) return 'Bahaya';
    if ($level >= 50) return 'Siaga';
    return 'Aman';
}

class SensorController {
    private $db;
    private $sensorModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=auth&action=login");
            exit();
        }
    
        $database = new Database();
        $this->db = $database->getConnection();
        require_once 'models/Sensor.php';
        $this->sensorModel = new Sensor($this->db);
    }

    public function index() {
        $sensors = $this->sensorModel->getAll();
        require_once 'views/sensors/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $location = htmlspecialchars($_POST['location_name']);
            $level = (int)$_POST['water_level'];
            $status = determineStatus($level);
            
            $uploadResult = uploadPhoto($_FILES['photo'] ?? null);
            
            if ($uploadResult['status']) {
                $this->sensorModel->create($location, $level, $status, $uploadResult['path']);
                header("Location: index.php?page=sensor&action=index&msg=Data+Ditambahkan");
                exit(); // Perbaikan 3: Wajib ada exit() setelah header location
            } else {
                $error = $uploadResult['msg'];
                require_once 'views/sensors/create.php';
                return;
            }
        } else {
            require_once 'views/sensors/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? $_POST['id'] ?? null;
        
        if (!$id) { 
            header("Location: index.php?page=sensor&action=index"); 
            exit(); 
        }
        
        $sensor = $this->sensorModel->getById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $location = htmlspecialchars($_POST['location_name']);
            $level = (int)$_POST['water_level'];
            $status = determineStatus($level);
            
            $uploadResult = uploadPhoto($_FILES['photo'] ?? null);
            
            if ($uploadResult['status']) {
                $this->sensorModel->update($id, $location, $level, $status, $uploadResult['path']);
                header("Location: index.php?page=sensor&action=index&msg=Data+Diperbarui");
                exit(); 
            } else {
                $error = $uploadResult['msg'];
            }
        }
        require_once 'views/sensors/edit.php';
    }

    public function delete() {
 
        $id = $_GET['id'] ?? $_POST['id'] ?? null;
        
        if ($id) {
            $this->sensorModel->delete($id);
        }
        
        header("Location: index.php?page=sensor&action=index&msg=Data+Dihapus");
        exit();
    }
}
?>