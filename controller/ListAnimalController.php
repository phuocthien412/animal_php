<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/ListAnimal.php';

class ListAnimalController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new list animal
    public function createListAnimal($data) {
        $sql = "INSERT INTO listanimals (animalimage, animals_id) VALUES (:animalimage, :animals_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all list animals
    public function getAllListAnimals() {
        $sql = "SELECT * FROM listanimals";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single list animal by ID
    public function getListAnimalById($id) {
        $sql = "SELECT * FROM listanimals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing list animal
    public function updateListAnimal($id, $data) {
        $sql = "UPDATE listanimals SET animalimage = :animalimage, animals_id = :animals_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a list animal
    public function deleteListAnimal($id) {
        $sql = "DELETE FROM listanimals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>