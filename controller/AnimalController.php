<?php
// filepath: e:\laragon\www\animal_php\controller\AnimalController.php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Animal.php';

class AnimalController {
    private $db;
    private $model;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->model = new Animal();
    }

    // Create a new animal
    public function createAnimal($data) {
        $sql = "INSERT INTO animals (name, gioi_thieu_text, ngoai_hinh_text, noi_sinh_song_text, avatar, noi_sinh_song_image, imgqr3d, classanimals_id) 
                VALUES (:name, :gioi_thieu_text, :ngoai_hinh_text, :noi_sinh_song_text, :avatar, :noi_sinh_song_image, :imgqr3d, :classanimals_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId(); // Return the ID of the newly created animal
    }

    // Read all animals
    public function getAllAnimals() {
        $sql = "SELECT * FROM animals";
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
        $sql = "SELECT * FROM classanimals WHERE id_class = :id"; // Updated table name
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAnimalImagesById($id) {
    $sql = "SELECT animalimage FROM listanimals WHERE animals_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function deleteAnimal($id) {
    try {
        // Begin a transaction
        $this->db->beginTransaction();

        // Delete associated images from the listanimals table
        $sqlDeleteImages = "DELETE FROM listanimals WHERE animals_id = :id";
        $stmtDeleteImages = $this->db->prepare($sqlDeleteImages);
        $stmtDeleteImages->execute(['id' => $id]);

        // Delete the animal from the animals table
        $sqlDeleteAnimal = "DELETE FROM animals WHERE id_animal = :id";
        $stmtDeleteAnimal = $this->db->prepare($sqlDeleteAnimal);
        $stmtDeleteAnimal->execute(['id' => $id]);

        // Commit the transaction
        $this->db->commit();

        return true;
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $this->db->rollBack();
        throw $e;
    }
}
public function updateAnimal($id, $data) {
    try {
        $sql = "UPDATE animals 
                SET name = :name, 
                    gioi_thieu_text = :gioi_thieu_text, 
                    ngoai_hinh_text = :ngoai_hinh_text, 
                    noi_sinh_song_text = :noi_sinh_song_text, 
                    classanimals_id = :classanimals_id 
                WHERE id_animal = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'gioi_thieu_text' => $data['gioi_thieu_text'],
            'ngoai_hinh_text' => $data['ngoai_hinh_text'],
            'noi_sinh_song_text' => $data['noi_sinh_song_text'],
            'classanimals_id' => $data['classanimals_id'],
            'id' => $id
        ]);
        return $stmt->rowCount(); // Return the number of affected rows
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function handleAnimalsList($searchQuery = '') {
    $animals = $this->getAllAnimals();
    
    if ($searchQuery !== '') {
        $animals = $this->searchAnimals($animals, $searchQuery);
    }
    
    return [
        'animals' => $animals,
        'searchQuery' => $searchQuery
    ];
}

private function searchAnimals($animals, $searchQuery) {
    if ($searchQuery === 'Unknown') {
        return [];
    }

    $normalizedSearchQuery = $this->normalizeString($searchQuery);
    
    $exactMatches = array_filter($animals, function($animal) use ($searchQuery) {
        return mb_strtolower($animal['name'], 'UTF-8') === mb_strtolower($searchQuery, 'UTF-8');
    });

    if (!empty($exactMatches)) {
        return $exactMatches;
    }

    return array_filter($animals, function($animal) use ($normalizedSearchQuery) {
        return mb_stripos($this->normalizeString($animal['name']), $normalizedSearchQuery) !== false;
    });
}

private function normalizeString($str) {
    $str = mb_strtolower($str, 'UTF-8');
    $str = preg_replace('/[áàảãạâấầẩẫậăắằẳẵặ]/u', 'a', $str);
    $str = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $str);
    $str = preg_replace('/[íìỉĩị]/u', 'i', $str);
    $str = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $str);
    $str = preg_replace('/[úùủũụưứừửữự]/u', 'u', $str);
    $str = preg_replace('/[ýỳỷỹỵ]/u', 'y', $str);
    $str = preg_replace('/đ/u', 'd', $str);
    return $str;
}
}
?>