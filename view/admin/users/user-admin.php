<?php

$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Correct the path to header.php
    include '../../headerAdmin.php';

    // Correct the path to UserController.php
    require_once '../../../controller/UserController.php';

    // Initialize UserController
    $userController = new UserController();

    // Fetch users and their roles from the database
    $users = $userController->getAllUsersWithRoles();

    // Check if the current user has the "ADMIN" role
    $isAdmin = isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles']);
    ?>
    <section style="padding: 0;">
        <div class="container mt-4">
            <h1>Account list</h1>

            <!-- Display success or error messages -->
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($user['roles'] as $role): ?>
                                        <li><?= htmlspecialchars($role) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <!-- Delete button -->
                                    <!-- Delete button -->
                                    <a href="/animal_php/admin/users/delete/<?= urlencode($user['id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>

                                    <!-- Edit Role button -->
                                    <a href="/animal_php/admin/users/editRole/<?= urlencode($user['id']) ?>"
                                        class="btn btn-warning btn-sm">Edit Role</a>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>