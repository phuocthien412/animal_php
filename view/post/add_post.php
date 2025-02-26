<?php
require_once '../../controller/PostController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'date' => $_POST['date'],
        'image' => $_FILES['image']['name'],
        'title' => $_POST['title'],
        'user_id' => $_POST['user_id']
    ];

    // Ensure the target directory exists
    $target_dir = "../../images/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Handle file upload
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $postController = new PostController();
        $result = $postController->createPost($data);

        if ($result) {
            header("Location: list_posts.php");
            exit();
        } else {
            echo "Error: Unable to create post.";
        }
    } else {
        echo "Error: Unable to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Thêm bài viết</h2>
    <form action="add_post.php" method="POST" enctype="multipart/form-data">
        <label>Ngày:</label>
        <input type="datetime-local" name="date" required><br>
        
        <label>Hình ảnh:</label>
        <input type="file" name="image" required><br>
        
        <label>Tiêu đề:</label>
        <input type="text" name="title" required><br>
        
        <label>ID Người dùng:</label>
        <input type="text" name="user_id" required><br>
        
        <button type="submit">Thêm</button>
    </form>
</body>
</html>