<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include the admin header
    include '../../headerAdmin.php';

    // Include the PostController and UserController
    require_once '../../../controller/PostController.php';
    require_once '../../../controller/UserController.php';

    // Initialize controllers
    $postController = new PostController();
    $userController = new UserController();

    // Fetch posts from the database
    $posts = $postController->getAllPosts();

    // Check if the current user has the "ADMIN" role
    $isAdmin = isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles']);
    ?>
    <section style="padding: 0;">
        <div class="container mt-4">
            <h1>Post List</h1>

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
                        <th>Title</th>
                        <th>Author</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['id_post']) ?></td>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td>
                                <?php
                                // Fetch the username for the user_id
                                $username = $userController->getUsernameById($post['user_id']);
                                echo htmlspecialchars($username);
                                ?>
                            </td>
                            <td>
                                <img src="/animal_php/images/<?= htmlspecialchars($post['image']) ?>" alt="Post Image"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($post['date']) ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <a href="/animal_php/posts/detail/<?= urlencode($post['id_post']) ?>"
                                        class="btn btn-warning btn-sm">View</a>
                                    <a href="/animal_php/view/admin/posts/delete-post.php?id=<?= urlencode($post['id_post']) ?>"
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