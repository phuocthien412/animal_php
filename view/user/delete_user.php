<?php
require_once '../../controller/UserController.php';

if (!isset($_GET['id'])) {
    header("Location: ../user-admin.php?error=Missing user ID");
    exit();
}

$userId = $_GET['id'];
$userController = new UserController();

if ($userController->deleteUser($userId)) {
    header("Location: ../user-admin.php?success=User deleted successfully");
} else {
    header("Location: ../user-admin.php?error=Failed to delete user");
}
exit();
?>