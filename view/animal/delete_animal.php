<?php
require_once '../../controller/AnimalController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $animalController = new AnimalController();
    $animalController->deleteAnimal($id);
}

header("Location: ../../index.php");
exit();
?>