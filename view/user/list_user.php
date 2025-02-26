<?php
require_once '../../controller/UserController.php';

$userController = new UserController();
$users = $userController->getAllUsers();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <a href="add_user.php">Thêm người dùng</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Provider</th>
            <th>Roles</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="7" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['provider'] ?? '') ?></td>
                    <td>
                        <?php
                        $userRoles = $userController->getUserRoles($user['id']);
                        foreach ($userRoles as $role) {
                            echo htmlspecialchars($role['name']) . '<br>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?= htmlspecialchars($user['id'] ?? '') ?>">Sửa</a>
                        <a href="delete_user.php?id=<?= htmlspecialchars($user['id'] ?? '') ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>