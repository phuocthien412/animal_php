<?php
session_start();
require_once '../../controller/UserController.php';

$userController = new UserController();

$username = $_POST['username'];
$password = $_POST['password'];

$user = $userController->loginUser($username, $password);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['roles'] = $user['roles']; // Store roles in session
    header('Location: /animal_php/Home');
} else {
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: login.php');
}
exit();
?>