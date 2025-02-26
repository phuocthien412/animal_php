<?php
require_once '../../controller/CommentController.php';

$commentController = new CommentController();
$comment = $commentController->getCommentById($_GET['id_cmt']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cmt = $_POST['id_cmt'];
    $data = [
        'chat_data' => $_POST['chat_data'],
        'date_time' => $_POST['date_time'],
        'post_id' => $_POST['post_id'],
        'user_id' => $_POST['user_id']
    ];

    $commentController->updateComment($id_cmt, $data);

    header("Location: list_comments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bình luận</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Chỉnh sửa bình luận</h2>
    <form action="edit_comment.php?id_cmt=<?= htmlspecialchars($comment['id_cmt'] ?? '') ?>" method="POST">
        <input type="hidden" name="id_cmt" value="<?= htmlspecialchars($comment['id_cmt'] ?? '') ?>">

        <label>Nội dung:</label>
        <input type="text" name="chat_data" value="<?= htmlspecialchars($comment['chat_data'] ?? '') ?>" required><br>
        
        <label>Ngày giờ:</label>
        <input type="datetime-local" name="date_time" value="<?= htmlspecialchars($comment['date_time'] ?? '') ?>" required><br>
        
        <label>ID Bài viết:</label>
        <input type="text" name="post_id" value="<?= htmlspecialchars($comment['post_id'] ?? '') ?>" required><br>
        
        <label>ID Người dùng:</label>
        <input type="text" name="user_id" value="<?= htmlspecialchars($comment['user_id'] ?? '') ?>" required><br>
        
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>