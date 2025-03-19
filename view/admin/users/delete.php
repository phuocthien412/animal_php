<?php
require_once '../../../controller/UserController.php';

if (!isset($_GET['id'])) {
    header("Location: /animal_php/admin/users?error=Missing user ID");
    exit();
}

$userId = $_GET['id'];
$userController = new UserController();

if ($userController->deleteUser($userId)) {
    header("Location: /animal_php/admin/users?success=User deleted successfully");
} else {
    header("Location: /animal_php/admin/users?error=Failed to delete user");
}
exit();
?>