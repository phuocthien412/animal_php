<?php
require_once '../../../controller/AnimalController.php';
require_once '../../../controller/ClassAnimalController.php';

$animalController = new AnimalController();
$classAnimalController = new ClassAnimalController();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $animalId = intval($_GET['id']);
    $animal = $animalController->getAnimalById($animalId);
    $classAnimals = $classAnimalController->getAllClassAnimals();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $animalId = intval($_POST['id']);
    $data = [
        'name' => $_POST['name'],
        'gioi_thieu_text' => $_POST['gioi_thieu_text'],
        'ngoai_hinh_text' => $_POST['ngoai_hinh_text'],
        'noi_sinh_song_text' => $_POST['noi_sinh_song_text'],
        'classanimals_id' => $_POST['classanimals_id']
    ];

    // Debugging: Check the data being passed
    var_dump($animalId);
    var_dump($data);

    $result = $animalController->updateAnimal($animalId, $data);

    // Debugging: Check the result of the update
    var_dump($result);

    if ($result) {
        header("Location: /animal_php/admin/animals?success=Animal updated successfully");
    } else {
        echo "Failed to update the animal.";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include '../../headerAdmin.php'; ?>
    <div class="container mt-5">
        <h1>Edit Animal</h1>
        <form action="/animal_php/view/admin/animals/edit" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($animal['id_animal']) ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($animal['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="gioi_thieu_text">Introduction:</label>
                <textarea class="form-control" id="gioi_thieu_text" name="gioi_thieu_text" required><?= htmlspecialchars($animal['gioi_thieu_text']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="ngoai_hinh_text">Appearance:</label>
                <textarea class="form-control" id="ngoai_hinh_text" name="ngoai_hinh_text" required><?= htmlspecialchars($animal['ngoai_hinh_text']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="noi_sinh_song_text">Habitat Description:</label>
                <textarea class="form-control" id="noi_sinh_song_text" name="noi_sinh_song_text" required><?= htmlspecialchars($animal['noi_sinh_song_text']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="classanimals_id">Class Animal:</label>
                <select class="form-control" id="classanimals_id" name="classanimals_id" required>
                    <?php foreach ($classAnimals as $classAnimal): ?>
                        <option value="<?= htmlspecialchars($classAnimal['id_class']) ?>" <?= $classAnimal['id_class'] == $animal['classanimals_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($classAnimal['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/animal_php/admin/animals" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>