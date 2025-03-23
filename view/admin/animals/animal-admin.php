<!DOCTYPE html>
<html lang="en">

<head>
    <title>Animal List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include the admin header
    include '../../headerAdmin.php';

    // Include the AnimalController
    require_once '../../../controller/AnimalController.php';

    // Initialize AnimalController
    $animalController = new AnimalController();

    // Fetch animals from the database
    $animals = $animalController->getAllAnimals();

    // Check if the current user has the "ADMIN" role
    $isAdmin = isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles']);
    ?>
    <section style="padding: 0;">
        <div class="container mt-4">
            <h1>Animal List</h1>

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
            <div class="mb-3">
                <a href="/animal_php/admin/animals/add" class="btn btn-success">Add Animal</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Introduction</th>
                        <th>3D QR Image</th>
                        <th>Appearance</th>
                        <th>Habitat Image</th>
                        <th>Habitat Description</th>
                        <th>Name</th>
                        <th>Class ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($animals as $animal): ?>
                        <tr>
                            <td><?= htmlspecialchars($animal['id_animal']) ?></td>
                            <td><img src="/animal_php/images/<?= htmlspecialchars($animal['avatar']) ?>" alt="Avatar" width="100"></td>
                            <td><?= htmlspecialchars($animal['gioi_thieu_text']) ?></td>
                            <td><img src="/animal_php/images/<?= htmlspecialchars($animal['imgqr3d']) ?>" alt="3D QR" width="100"></td>
                            <td><?= htmlspecialchars($animal['ngoai_hinh_text']) ?></td>
                            <td><img src="/animal_php/images/<?= htmlspecialchars($animal['noi_sinh_song_image']) ?>" alt="Habitat" width="100"></td>
                            <td><?= htmlspecialchars($animal['noi_sinh_song_text']) ?></td>
                            <td><?= htmlspecialchars($animal['name']) ?></td>
                            <td><?= htmlspecialchars($animal['classanimals_id']) ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    
                                    <!-- View button -->
                                    <a href="/animal_php/animal/detail/<?= urlencode($animal['id_animal']) ?>"
                                        class="btn btn-info btn-sm">View</a>
                                    <!-- Edit button -->
                                    <a href="/animal_php/admin/animals/edit/<?= urlencode($animal['id_animal']) ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                        <!-- Delete button -->
                                    <a href="/animal_php/admin/animals/delete/<?= urlencode($animal['id_animal']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this animal?')">Delete</a>
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