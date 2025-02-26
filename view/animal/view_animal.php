<?php
require_once '../../controller/AnimalController.php';

if (!isset($_GET['id'])) {
    echo "Invalid animal ID.";
    exit();
}

$animalController = new AnimalController();
$animal = $animalController->getAnimalById($_GET['id']);

if (!$animal) {
    echo "Animal not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .animal-details { max-width: 600px; margin: auto; }
        .animal-details img { max-width: 100%; height: auto; }
        .animal-details h2 { margin-top: 0; }
    </style>
</head>
<body>
    <div class="animal-details">
        <h2><?= htmlspecialchars($animal['name'] ?? '') ?></h2>
        <p><strong>Giới thiệu:</strong> <?= htmlspecialchars($animal['gioi_thieu_text'] ?? '') ?></p>
        <p><strong>Ngoại hình:</strong> <?= htmlspecialchars($animal['ngoai_hinh_text'] ?? '') ?></p>
        <p><strong>Nơi sinh sống:</strong> <?= htmlspecialchars($animal['noi_sinh_song_text'] ?? '') ?></p>
        <p><strong>Hình ảnh đại diện:</strong></p>
        <img src="<?= htmlspecialchars($animal['avatar'] ?? '') ?>" alt="Avatar">
        <p><strong>Hình ảnh nơi sinh sống:</strong></p>
        <img src="<?= htmlspecialchars($animal['noi_sinh_song_image'] ?? '') ?>" alt="NoiSinhSongImage">
        <p><strong>Hình ảnh QR 3D:</strong></p>
        <img src="<?= htmlspecialchars($animal['img_qr_3d'] ?? '') ?>" alt="ImgQR3D">
    </div>
</body>
</html>