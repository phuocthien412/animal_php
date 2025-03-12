<?php
// filepath: e:\laragon\www\animal_php\controller\AnimalController.php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Animal.php';
require_once __DIR__ . '/../model/ListAnimal.php';

class AnimalController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new animal
    public function createAnimal($data) {
        $sql = "INSERT INTO animals (name, gioi_thieu_text, ngoai_hinh_text, noi_sinh_song_text, avatar, noi_sinh_song_image, imgqr3d, classanimals_id) 
                VALUES (:name, :gioi_thieu_text, :ngoai_hinh_text, :noi_sinh_song_text, :avatar, :noi_sinh_song_image, :imgqr3d, :classanimals_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all animals
    public function getAllAnimals() {
        $sql = "SELECT id_animal, name, gioi_thieu_text, avatar FROM animals";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single animal by ID
    public function getAnimalById($id) {
        $sql = "SELECT * FROM animals WHERE id_animal = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch class animal information by ID
    public function getClassAnimalInfoById($id) {
        $sql = "SELECT * FROM classanimals WHERE id_class = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch images related to a specific animal
    public function getAnimalImagesById($id) {
        $sql = "SELECT animalimage FROM listanimals WHERE animals_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>