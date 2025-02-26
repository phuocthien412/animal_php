<?php
require_once '../../controller/UserController.php';
require_once '../../controller/RoleController.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'phone' => $_POST['phone'],
        'provider' => $_POST['provider'],
        'username' => $_POST['username'],
        'roles' => $_POST['roles'] ?? []
    ];

    $userController = new UserController();
    $result = $userController->createUser($data);

    if ($result === 'duplicate') {
        $error = 'Email đã tồn tại. Vui lòng sử dụng email khác.';
    } else {
        header("Location: list_user.php");
        exit();
    }
}

$roleController = new RoleController();
$roles = $roleController->getAllRoles();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
</head>
<body>
    <h2>Thêm người dùng</h2>
    <?php if ($error): ?>
        <div style="color: red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="add_user.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Phone:</label>
        <input type="text" name="phone"><br>
        
        <label>Provider:</label>
        <input type="text" name="provider"><br>
        
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Roles:</label>
        <select name="roles[]" multiple>
            <?php foreach ($roles as $role): ?>
                <option value="<?= htmlspecialchars($role['id']) ?>"><?= htmlspecialchars($role['name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>