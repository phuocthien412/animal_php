<?php
require_once '../../controller/CommentController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'chat_data' => $_POST['chat_data'],
        'date_time' => $_POST['date_time'],
        'post_id' => $_POST['post_id'],
        'user_id' => $_POST['user_id']
    ];

    $commentController = new CommentController();
    $commentController->createComment($data);

    header("Location: list_comments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bình luận</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Thêm bình luận</h2>
    <form action="add_comment.php" method="POST">
        <label>Nội dung:</label>
        <input type="text" name="chat_data" required><br>
        
        <label>Ngày giờ:</label>
        <input type="datetime-local" name="date_time" required><br>
        
        <label>ID Bài viết:</label>
        <input type="text" name="post_id" required><br>
        
        <label>ID Người dùng:</label>
        <input type="text" name="user_id" required><br>
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>