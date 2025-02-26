<?php
require_once '../../controller/ListAnimalController.php';

$listAnimalController = new ListAnimalController();
$listAnimals = $listAnimalController->getAllListAnimals();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách động vật</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h1>Danh sách động vật</h1>
    <a href="add_listanimal.php" class="btn btn-primary">Thêm động vật</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Ảnh động vật</th>
            <th>ID động vật</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($listAnimals)): ?>
            <tr>
                <td colspan="4" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($listAnimals as $listAnimal): ?>
                <tr>
                    <td><?= htmlspecialchars($listAnimal['id'] ?? '') ?></td>
                    <td>
                        <?php
                        $images = explode(',', $listAnimal['animalimage']);
                        foreach ($images as $image) {
                            echo '<img src="/images/' . htmlspecialchars($image) . '" width="100" height="100">';
                        }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($listAnimal['animals_id'] ?? '') ?></td>
                    <td>
                        <a href="edit_listanimal.php?id=<?= htmlspecialchars($listAnimal['id'] ?? '') ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete_listanimal.php?id=<?= htmlspecialchars($listAnimal['id'] ?? '') ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>