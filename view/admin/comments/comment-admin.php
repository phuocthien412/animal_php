<!DOCTYPE html>
<html lang="en">

<head>
    <title>Comment List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include the admin header
    include '../../headerAdmin.php';

    // Include the CommentController
    require_once '../../../controller/CommentController.php';

    // Initialize CommentController
    $commentController = new CommentController();

    // Fetch comments from the database
    $comments = $commentController->getAllComments();

    // Check if the current user has the "ADMIN" role
    $isAdmin = isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles']);
    ?>
    <section style="padding: 0;">
        <div class="container mt-4">
            <h1>Comment List</h1>

            <!-- Display success or error messages -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Post ID</th>
                        <th>User ID</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['id_cmt']) ?></td>
                            <td><?= htmlspecialchars($comment['post_id']) ?></td>
                            <td><?= htmlspecialchars($comment['user_id']) ?></td>
                            <td><?= htmlspecialchars($comment['chat_data']) ?></td>
                            <td><?= htmlspecialchars($comment['date_time']) ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <a href="/animal_php/view/admin/comments/delete-comment.php?id=<?= urlencode($comment['id_cmt']) ?>"
    class="btn btn-danger btn-sm">Delete</a>    
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>