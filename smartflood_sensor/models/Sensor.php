<?php
class Sensor {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function getAll() {
        $query = "SELECT * FROM flood_sensors ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $query = "SELECT * FROM flood_sensors WHERE id = :id LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($location_name, $water_level, $status, $file_path) {
        $query = "INSERT INTO flood_sensors (location_name, water_level_cm, status, latest_photo) VALUES (:location, :level, :status, :photo)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':location' => $location_name,
            ':level' => $water_level,
            ':status' => $status,
            ':photo' => $file_path
        ]);
    }

    public function update($id, $location_name, $water_level, $status, $file_path) {
        if ($file_path) {
            $query = "UPDATE flood_sensors SET location_name = :location, water_level_cm = :level, status = :status, latest_photo = :photo, last_updated = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':location' => $location_name, ':level' => $water_level, ':status' => $status, ':photo' => $file_path, ':id' => $id]);
        } else {
            $query = "UPDATE flood_sensors SET location_name = :location, water_level_cm = :level, status = :status, last_updated = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':location' => $location_name, ':level' => $water_level, ':status' => $status, ':id' => $id]);
        }
    }
    
    public function delete($id) {
        $query = "DELETE FROM flood_sensors WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>