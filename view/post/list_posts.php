<?php
require_once '../../controller/PostController.php';

$postController = new PostController();
$posts = $postController->getAllPosts();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h1>Danh sách bài viết</h1>
    <a href="add_post.php" class="btn btn-primary">Thêm bài viết</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Ngày</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>ID_USERS</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($posts)): ?>
            <tr>
                <td colspan="6" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['id_post'] ?? '') ?></td>
                    <td><?= htmlspecialchars($post['date'] ?? '') ?></td>
                    <td><img src="/images/<?= htmlspecialchars($post['image'] ?? '') ?>" alt="Image" width="100"></td>
                    <td><?= htmlspecialchars($post['title'] ?? '') ?></td>
                    <td><?= htmlspecialchars($post['user_id'] ?? '') ?></td>
                    <td>
                        <a href="edit_post.php?id_post=<?= htmlspecialchars($post['id_post'] ?? '') ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete_post.php?id_post=<?= htmlspecialchars($post['id_post'] ?? '') ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>