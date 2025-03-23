<?php
require_once '../../../controller/AnimalController.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $animalId = intval($_GET['id']);
    $animalController = new AnimalController();

    try {
        $animalController->deleteAnimal($animalId);
        header("Location: /animal_php/admin/animals?success=Animal deleted successfully");
    } catch (Exception $e) {
        header("Location: /animal_php/admin/animals?error=" . urlencode($e->getMessage()));
    }
    exit();
}
?>