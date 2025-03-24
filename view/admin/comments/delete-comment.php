<?php
require_once '../../../controller/CommentController.php';

// Start session to check admin privileges
session_start();

// Check if the user is an admin
if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])) {
    header('Location: /animal_php/view/admin/comments/comment-admin.php?error=Unauthorized');
    exit();
}

// Check if the comment ID is provided
if (isset($_GET['id'])) {
    $commentId = intval($_GET['id']);
    $commentController = new CommentController();

    try {
        // Delete the comment
        $commentController->deleteComment($commentId);
        header('Location: /animal_php/view/admin/comments/comment-admin.php?success=Comment deleted successfully');
    } catch (Exception $e) {
        header('Location: /animal_php/view/admin/comments/comment-admin.php?error=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: /animal_php/view/admin/comments/comment-admin.php?error=Invalid comment ID');
}
?>