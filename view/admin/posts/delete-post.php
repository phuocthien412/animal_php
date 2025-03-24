<?php
require_once '../../../controller/PostController.php';

// Start session to check admin privileges
session_start();

// Check if the user is an admin
if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])) {
    header('Location: /animal_php/view/admin/posts/post-admin.php?error=Unauthorized');
    exit();
}

// Check if the post ID is provided
if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $postController = new PostController();

    try {
        // Delete the post
        $postController->deletePost($postId);
        header('Location: /animal_php/view/admin/posts/post-admin.php?success=Post deleted successfully');
    } catch (Exception $e) {
        header('Location: /animal_php/view/admin/posts/post-admin.php?error=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: /animal_php/view/admin/posts/post-admin.php?error=Invalid post ID');
}
?>