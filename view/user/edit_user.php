<?php
require_once '../../controller/UserController.php';
require_once '../../controller/RoleController.php';

$userController = new UserController();
$roleController = new RoleController();

$user = $userController->getUserById($_GET['id']);
$userRoles = $userController->getUserRoles($user['id']);
$roles = $roleController->getAllRoles();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = [
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'provider' => $_POST['provider'],
        'username' => $_POST['username']
    ];

    // Only update the password if the user wants to change it
    if (!empty($_POST['password'])) {
        $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    $userController->updateUser($id, $data);

    // Update user roles
    $userController->deleteUserRoles($id); // Delete existing roles
    if (!empty($_POST['roles'])) {
        foreach ($_POST['roles'] as $roleId) {
            $userController->assignRoleToUser($id, $roleId);
        }
    }

    header("Location: list_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Chỉnh sửa người dùng</h2>
    <form action="edit_user.php?id=<?= htmlspecialchars($user['id'] ?? '') ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required><br>
        
        <label>Change Password:</label>
        <input type="checkbox" id="changePasswordCheckbox"><br>
        
        <label>Password:</label>
        <input type="password" name="password" id="passwordField" disabled><br>
        
        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"><br>
        
        <label>Provider:</label>
        <input type="text" name="provider" value="<?= htmlspecialchars($user['provider'] ?? '') ?>"><br>
        
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required><br>
        
        <label>Roles:</label>
        <select name="roles[]" multiple>
            <?php foreach ($roles as $role): ?>
                <option value="<?= htmlspecialchars($role['id']) ?>" <?= in_array($role, $userRoles) ? 'selected' : '' ?>><?= htmlspecialchars($role['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit">Lưu thay đổi</button>
    </form>

    <script>
        document.getElementById('changePasswordCheckbox').addEventListener('change', function() {
            document.getElementById('passwordField').disabled = !this.checked;
        });
    </script>
</body>
</html>