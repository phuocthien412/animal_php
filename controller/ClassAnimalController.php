<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/ClassAnimal.php';

class ClassAnimalController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new class animal
    public function createClassAnimal($data) {
        $sql = "INSERT INTO classanimals (background_video, info, name) 
                VALUES (:background_video, :info, :name)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all class animals
    public function getAllClassAnimals() {
        $sql = "SELECT id_class, background_video, info, name FROM classanimals";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single class animal by ID
    public function getClassAnimalById($id) {
        $sql = "SELECT * FROM classanimals WHERE id_class = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing class animal
    public function updateClassAnimal($id, $data) {
        $sql = "UPDATE classanimals SET background_video = :background_video, info = :info, name = :name WHERE id_class = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a class animal
    public function deleteClassAnimal($id) {
        $sql = "DELETE FROM classanimals WHERE id_class = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>