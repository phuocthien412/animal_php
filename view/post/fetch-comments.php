<?php
require_once '../../controller/CommentController.php';
require_once '../../controller/UserController.php';

header('Content-Type: application/json');

// Get the post ID from the request
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id > 0) {
    $commentController = new CommentController();
    $userController = new UserController();

    // Fetch comments for the post
    $comments = $commentController->getCommentsByPostId($post_id);

    // Add usernames to the comments
    foreach ($comments as $key => $comment) {
        $comments[$key]['username'] = $userController->getUsernameById($comment['user_id']);
    }

    // Return comments as JSON
    echo json_encode($comments);
} else {
    echo json_encode(['error' => 'Invalid post ID']);
}
?>