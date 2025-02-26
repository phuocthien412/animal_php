<?php
require_once '../../controller/AnimalController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'gioi_thieu_text' => $_POST['gioi_thieu_text'],
        'ngoai_hinh_text' => $_POST['ngoai_hinh_text'],
        'noi_sinh_song_text' => $_POST['noi_sinh_song_text'],
        'avatar' => $_POST['avatar'],
        'noi_sinh_song_image' => $_POST['noi_sinh_song_image'],
        'imgqr3d' => $_POST['imgqr3d'],
        'classanimals_id' => $_POST['classanimals_id']
    ];
    
    $animalController = new AnimalController();
    $animalController->createAnimal($data);

    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 400px; margin: auto; }
        label, input, textarea { display: block; width: 100%; margin-bottom: 10px; }
        button { padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h2>Thêm động vật</h2>
    <form action="create_animal.php" method="POST">
        <label>Tên:</label>
        <input type="text" name="name" required>
        
        <label>Giới thiệu:</label>
        <textarea name="gioi_thieu_text" required></textarea>
        
        <label>Ngoại hình:</label>
        <textarea name="ngoai_hinh_text" required></textarea>
        
        <label>Nơi sinh sống:</label>
        <textarea name="noi_sinh_song_text" required></textarea>
        
        <label>Hình ảnh đại diện (URL):</label>
        <input type="file" name="avatar">
        
        <label>Hình ảnh nơi sinh sống (URL):</label>
        <input type="file" name="noi_sinh_song_image">
        
        <label>Hình ảnh QR 3D (URL):</label>
        <input type="file"name="imgqr3d">
        
        <label>Class Animal:</label>
        <input type="text" name="classanimals_id">
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>