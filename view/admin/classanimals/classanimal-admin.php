<!DOCTYPE html>
<html lang="en">

<head>
    <title>Class Animals List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include the admin header
    include '../../headerAdmin.php';

    // Include the ClassAnimalController
    require_once '../../../controller/ClassAnimalController.php';

    // Initialize ClassAnimalController
    $classAnimalController = new ClassAnimalController();

    // Fetch class animals from the database
    $classAnimals = $classAnimalController->getAllClassAnimals();

    // Check if the current user has the "ADMIN" role
    $isAdmin = isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles']);
    ?>
    <section style="padding: 0;">
        <div class="container mt-4">
            <h1>Class Animals List</h1>

            <!-- Display success or error messages -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Info</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classAnimals as $classAnimal): ?>
                        <tr>
                            <td><?= htmlspecialchars($classAnimal['id_class']) ?></td>
                            <td><?= htmlspecialchars($classAnimal['info']) ?></td>
                            <td><?= htmlspecialchars($classAnimal['name']) ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <!-- Delete button -->
                                    <a href="/animal_php/admin/classanimals/delete/<?= urlencode($classAnimal['id_class']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this class animal?')">Delete</a>

                                    <!-- Edit button -->
                                    <a href="/animal_php/admin/classanimals/edit/<?= urlencode($classAnimal['id_class']) ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
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