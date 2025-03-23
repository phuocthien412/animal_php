<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    echo '<script>window.location.href = "/animal_php/view/user/login.php";</script>';
    exit();
}

require_once '../../controller/PostController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the logged-in user's ID
    $user_id = $_SESSION['user_id'];

    // Get the current date and time
    $date = date('Y-m-d H:i:s');

    // Get the form data
    $title = $_POST['title'];
    $imageFile = $_FILES['imageFile'];

    // Handle file upload
    $uploadDir = __DIR__ . '/../../images/'; // Directory to save the uploaded images
    $uploadFile = $uploadDir . basename($imageFile['name']);

    if (move_uploaded_file($imageFile['tmp_name'], $uploadFile)) {
        // File uploaded successfully, save the post to the database
        $postController = new PostController();
        $postController->createPost([
            'date' => $date,
            'image' => $imageFile['name'], // Save only the file name in the database
            'title' => $title,
            'user_id' => $user_id,
        ]);

        // Redirect back to the posts list
        header("Location: /animal_php/view/post/posts-list.php");
        exit();
    } else {
        // Handle upload error
        echo '<script>alert("Failed to upload image. Please try again.");</script>';
        echo '<script>window.location.href = "/animal_php/view/post/posts-list.php";</script>';
        exit();
    }
}
?>