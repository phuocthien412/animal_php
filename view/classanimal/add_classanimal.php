<?php
require_once '../../controller/ClassAnimalController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'background_video' => $_POST['background_video'],
        'info' => $_POST['info'],
        'name' => $_POST['name']
    ];

    $classAnimalController = new ClassAnimalController();
    $classAnimalController->createClassAnimal($data);

    header("Location: list_classanimals.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lớp động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 400px; margin: auto; }
        label, input, textarea { display: block; width: 100%; margin-bottom: 10px; }
        button { padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h2>Thêm lớp động vật</h2>
    <form action="add_classanimal.php" method="POST">
        <label>Video nền:</label>
        <input type="file" name="background_video">
        
        <label>Thông tin:</label>
        <textarea name="info"></textarea>
        
        <label>Tên:</label>
        <input type="text" name="name" required>
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>