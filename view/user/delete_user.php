<?php
require_once '../../controller/UserController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $userController = new UserController();
    $userController->deleteUser($id);
}

header("Location: list_user.php");
exit();
?>