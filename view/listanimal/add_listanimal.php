<?php
require_once '../../controller/ListAnimalController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $animalImages = [];
    $uploadDir = '../../uploads/';

    // Handle multiple file uploads
    foreach ($_FILES['animalimage']['name'] as $key => $name) {
        if ($key < 3 && $_FILES['animalimage']['error'][$key] == 0) {
            $tmpName = $_FILES['animalimage']['tmp_name'][$key];
            $fileName = basename($name);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $uploadFile)) {
                $animalImages[] = $fileName;
            }
        }
    }

    $animalImages = implode(',', $animalImages); // Convert array to comma-separated string

    $data = [
        'animalimage' => $animalImages,
        'animals_id' => $_POST['animals_id']
    ];

    $listAnimalController = new ListAnimalController();
    $listAnimalController->createListAnimal($data);

    header("Location: list_listanimals.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm động vật vào danh sách</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Thêm động vật vào danh sách</h2>
    <form action="add_listanimal.php" method="POST" enctype="multipart/form-data">
        <label>Chọn ảnh động vật (tối đa 3 ảnh):</label>
        <input type="file" name="animalimage[]" multiple required>
        
        <label>ID động vật:</label>
        <input type="text" name="animals_id" required>
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>