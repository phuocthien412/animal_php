<?php
require_once '../../controller/PostController.php';

$postController = new PostController();
$post = $postController->getPostById($_GET['id_post']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_post = $_POST['id_post'];
    $data = [
        'date' => $_POST['date'],
        'image' => $_FILES['image']['name'],
        'title' => $_POST['title'],
        'user_id' => $_POST['user_id']
    ];

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $data['image'] = $post['image'];
    }

    $postController->updatePost($id_post, $data);

    header("Location: list_posts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
</head>
<body>
    <h2>Chỉnh sửa bài viết</h2>
    <form action="edit_post.php?id_post=<?= htmlspecialchars($post['id_post'] ?? '') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post'] ?? '') ?>">

        <label>Ngày:</label>
        <input type="datetime-local" name="date" value="<?= htmlspecialchars($post['date'] ?? '') ?>" required><br>
        
        <label>Hình ảnh:</label>
        <input type="file" name="image"><br>
        <img src="/images/<?= htmlspecialchars($post['image'] ?? '') ?>" alt="Image" width="100"><br>
        
        <label>Tiêu đề:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title'] ?? '') ?>" required><br>
        
        <label>ID Người dùng:</label>
        <input type="text" name="user_id" value="<?= htmlspecialchars($post['user_id'] ?? '') ?>" required><br>
        
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>