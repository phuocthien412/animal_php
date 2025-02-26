<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './controller/AnimalController.php';

$animalController = new AnimalController();
$animals = $animalController->getAllAnimals();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        img { max-width: 100px; height: auto; }
        .action-btn { padding: 5px 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .action-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Danh sách động vật</h1>
    <a href="view/animal/add_animal.php" class="action-btn">Thêm động vật</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giới thiệu</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($animals)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($animals as $animal): ?>
                <tr>
                    <td><?= htmlspecialchars($animal['id_animal'] ?? '') ?></td>
                    <td><a href="view/animal/view_animal.php?id=<?= htmlspecialchars($animal['id_animal'] ?? '') ?>"><?= htmlspecialchars($animal['name'] ?? '') ?></a></td>
                    <td><?= htmlspecialchars($animal['gioi_thieu_text'] ?? '') ?></td>
                    <td><img src="/Avatar/<?= htmlspecialchars($animal['avatar'] ?? '') ?>" alt="Avatar"></td>
                    <td>
                        <a href="view/animal/edit_animal.php?id=<?= htmlspecialchars($animal['id_animal'] ?? '') ?>" class="action-btn">Sửa</a>
                        <a href="view/animal/delete_animal.php?id=<?= htmlspecialchars($animal['id_animal'] ?? '') ?>" class="action-btn" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>