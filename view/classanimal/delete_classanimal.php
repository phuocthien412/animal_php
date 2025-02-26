<?php
require_once '../../controller/ClassAnimalController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $classAnimalController = new ClassAnimalController();
    $classAnimalController->deleteClassAnimal($id);
}

header("Location: list_classanimals.php");
exit();
?>