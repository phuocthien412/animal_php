<?php
require_once '../../controller/CommentController.php';

if (isset($_GET['id_cmt'])) {
    $id_cmt = $_GET['id_cmt'];

    $commentController = new CommentController();
    $commentController->deleteComment($id_cmt);
}

header("Location: list_comments.php");
exit();
?>