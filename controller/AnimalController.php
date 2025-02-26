<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Animal.php';

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

    // Update an existing animal
    public function updateAnimal($id, $data) {
        $sql = "UPDATE animals SET name = :name, gioi_thieu_text = :gioi_thieu_text, ngoai_hinh_text = :ngoai_hinh_text, noi_sinh_song_text = :noi_sinh_song_text, avatar = :avatar, noi_sinh_song_image = :noi_sinh_song_image, imgqr3d = :imgqr3d, classanimals_id = :classanimals_id WHERE id_animal = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete an animal
    public function deleteAnimal($id) {
        $sql = "DELETE FROM animals WHERE id_animal = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>