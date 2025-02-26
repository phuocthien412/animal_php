<?php
require_once '../../controller/ClassAnimalController.php';

$classAnimalController = new ClassAnimalController();
$classAnimal = $classAnimalController->getClassAnimalById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = [
        'background_video' => $_POST['background_video'],
        'info' => $_POST['info'],
        'name' => $_POST['name']
    ];

    $classAnimalController->updateClassAnimal($id, $data);

    header("Location: list_classanimals.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa lớp động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 400px; margin: auto; }
        label, input, textarea { display: block; width: 100%; margin-bottom: 10px; }
        button { padding: 10px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h2>Chỉnh sửa lớp động vật</h2>
    <form action="edit_classanimal.php?id=<?= htmlspecialchars($classAnimal['id_class'] ?? '') ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($classAnimal['id_class'] ?? '') ?>">

        <label>Video nền:</label>
        <input type="file" name="background_video" value="<?= htmlspecialchars($classAnimal['background_video'] ?? '') ?>">
        
        <label>Thông tin:</label>
        <textarea name="info"><?= htmlspecialchars($classAnimal['info'] ?? '') ?></textarea>
        
        <label>Tên:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($classAnimal['name'] ?? '') ?>" required>
        
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>