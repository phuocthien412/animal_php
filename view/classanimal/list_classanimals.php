<?php
require_once '../../controller/ClassAnimalController.php';

$classAnimalController = new ClassAnimalController();
$classAnimals = $classAnimalController->getAllClassAnimals();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp động vật</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .action-btn { padding: 5px 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .action-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Danh sách lớp động vật</h1>
    <a href="add_classanimal.php" class="action-btn">Thêm lớp động vật</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Video nền</th>
            <th>Thông tin</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($classAnimals)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($classAnimals as $classAnimal): ?>
                <tr>
                    <td><?= htmlspecialchars($classAnimal['id_class'] ?? '') ?></td>
                    <td><?= htmlspecialchars($classAnimal['name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($classAnimal['background_video'] ?? '') ?></td>
                    <td><?= htmlspecialchars($classAnimal['info'] ?? '') ?></td>
                    <td>
                        <a href="edit_classanimal.php?id=<?= htmlspecialchars($classAnimal['id_class'] ?? '') ?>" class="action-btn">Sửa</a>
                        <a href="delete_classanimal.php?id=<?= htmlspecialchars($classAnimal['id_class'] ?? '') ?>" class="action-btn" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>