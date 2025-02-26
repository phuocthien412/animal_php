<?php
require_once '../../controller/CommentController.php';

$commentController = new CommentController();
$comments = $commentController->getAllComments();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bình luận</title>
</head>
<body>
    <h1>Danh sách bình luận</h1>
    <a href="add_comment.php">Thêm bình luận</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nội dung</th>
            <th>Ngày giờ</th>
            <th>ID Bài viết</th>
            <th>ID Người dùng</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($comments)): ?>
            <tr>
                <td colspan="6" style="text-align: center;">Không có dữ liệu.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= htmlspecialchars($comment['id_cmt'] ?? '') ?></td>
                    <td><?= htmlspecialchars($comment['chat_data'] ?? '') ?></td>
                    <td><?= htmlspecialchars($comment['date_time'] ?? '') ?></td>
                    <td><?= htmlspecialchars($comment['post_id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($comment['user_id'] ?? '') ?></td>
                    <td>
                        <a href="edit_comment.php?id_cmt=<?= htmlspecialchars($comment['id_cmt'] ?? '') ?>">Sửa</a>
                        <a href="delete_comment.php?id_cmt=<?= htmlspecialchars($comment['id_cmt'] ?? '') ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>