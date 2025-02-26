<?php
require_once '../../controller/AnimalController.php';

$animalController = new AnimalController();
$animal = $animalController->getAnimalById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 400px; margin: auto; }
        label, input, textarea { display: block; width: 100%; margin-bottom: 10px; }
        button { padding: 10px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h2>Chỉnh sửa động vật</h2>
    <form action="update_animal.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($animal['id_animal'] ?? '') ?>">

        <label>Tên:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($animal['name'] ?? '') ?>" required>
        
        <label>Giới thiệu:</label>
        <textarea name="gioi_thieu_text" required><?= htmlspecialchars($animal['gioi_thieu_text'] ?? '') ?></textarea>
        
        <label>Ngoại hình:</label>
        <textarea name="ngoai_hinh_text" required><?= htmlspecialchars($animal['ngoai_hinh_text'] ?? '') ?></textarea>
        
        <label>Nơi sinh sống:</label>
        <textarea name="noi_sinh_song_text" required><?= htmlspecialchars($animal['noi_sinh_song_text'] ?? '') ?></textarea>
        
        <label>Hình ảnh đại diện (URL):</label>
        <input type="file" name="avatar" value="<?= htmlspecialchars($animal['avatar'] ?? '') ?>">
        
        <label>Hình ảnh nơi sinh sống (URL):</label>
        <input type="file" name="noi_sinh_song_image" value="<?= htmlspecialchars($animal['noi_sinh_song_image'] ?? '') ?>">
        
        <label>Hình ảnh QR 3D (URL):</label>
        <input type="file" name="imgqr3d" value="<?= htmlspecialchars($animal['imgqr3d'] ?? '') ?>">
        
        <label>Class Animal:</label>
        <input type="text" name="classanimals_id" value="<?= htmlspecialchars($animal['classanimals_id'] ?? '') ?>">
        
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>