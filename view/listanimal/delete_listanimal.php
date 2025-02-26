<?php
require_once '../../controller/ListAnimalController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $listAnimalController = new ListAnimalController();
    $listAnimalController->deleteListAnimal($id);
}

header("Location: list_listanimals.php");
exit();
?>