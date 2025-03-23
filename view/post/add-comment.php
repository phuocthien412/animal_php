<?php
require_once '../../controller/CommentController.php';
require_once '../../controller/UserController.php';

header('Content-Type: application/json');

// Start session to get the logged-in user
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['chatData'])) {
    $post_id = intval($_POST['post_id']);
    $chat_data = trim($_POST['chatData']);
    $user_id = $_SESSION['user_id'];

    if (!empty($chat_data)) {
        $commentController = new CommentController();
        $commentController->addComment($post_id, $user_id, $chat_data);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Comment cannot be empty']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>