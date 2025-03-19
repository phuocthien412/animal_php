<?php
require_once '../../../controller/UserController.php';
require_once '../../../controller/RoleController.php';

session_start();

// Check if the current user has the "ADMIN" role
if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])) {
    header("Location: /animal_php/view/admin/users/user-admin.php?error=Unauthorized access");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: /animal_php/view/admin/users/user-admin.php?error=Missing user ID");
    exit();
}

$userId = $_GET['id'];
$userController = new UserController();
$roleController = new RoleController();

// Fetch the user and all available roles
$user = $userController->getUserById($userId);
$roles = $roleController->getAllRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedRoles = $_POST['roles'] ?? [];
    if ($userController->updateUserRoles($userId, $selectedRoles)) {
        header("Location: /animal_php/admin/users?success=Roles updated successfully");
    } else {
        header("Location: /animal_php/admin/user?serror=Failed to update roles");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Roles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include '../../headerAdmin.php'; ?>
    <div class="container mt-4">
        <h1>Edit Roles for <?= htmlspecialchars($user['username']) ?></h1>
        <form action="/animal_php/admin/users/editRole/<?= urlencode($userId) ?>" method="POST">
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" id="roles" class="form-control" multiple>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role['id']) ?>"
                            <?= in_array($role['name'], $user['roles']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Roles</button>
            <a href="/animal_php/admin/users" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</body>
</html>