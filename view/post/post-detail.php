<?php

require_once '../../controller/PostController.php';
require_once '../../controller/CommentController.php';
require_once '../../controller/UserController.php';

// Get the post ID from the URL
$post_id = $_GET['id'];

// Initialize controllers
$postController = new PostController();
$commentController = new CommentController();
$userController = new UserController();

// Fetch the post details
$post = $postController->getPostById($post_id);
$post['username'] = $userController->getUsernameById($post['user_id']); // Fetch the username for the post

// Fetch comments for the post
$comments = $commentController->getCommentsByPostId($post_id);
foreach ($comments as $key => $comment) {
    $comments[$key]['username'] = $userController->getUsernameById($comment['user_id']); // Fetch the username for each comment
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post</title>
    <link rel="stylesheet" href="/animal_php/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/animal_php/css/mystyle.css" />
</head>

<body>
    <?php include '../header.php'; ?>
    <section class="Post" style="margin-top: -150px;">
        <div class="row">
            <!-- Post Details -->
            <div class="col-md-6">
                <div class="contain" style="width:800px;height:830px;margin-left:100px;">
                    <div class="card" style="width: 100%;height:100%;">
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/animal_php/view/design/Footer/nekoparalogo.png" width="50" class="rounded-circle"
                                    style="height:50px;width:50px;object-fit:cover">
                                <div class="d-flex flex-column ml-2" style="margin-left:10px">
                                    <span class="font-weight-bold"><?= htmlspecialchars($post['username']) ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-row mt-1 ellipsis">
                                <small class="mr-2" style="margin-top:10px"><?= htmlspecialchars($post['date']) ?></small>
                            </div>
                        </div>
                        <img src="/animal_php/images/<?= htmlspecialchars($post['image']) ?>" class="img-fluid"
                            style="width:100%;height:600px;object-fit:cover;">
                        <div class="p-2">
                            <p class="text-justify" style="font-size:20px;"><?= htmlspecialchars($post['title']) ?></p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/animal_php/Posts">
                                    <div class="d-flex flex-row icons d-flex align-items-center"><i
                                            class="fa fa-smile-o ml-2"></i></div>
                                    <div class="d-flex flex-row muted-color"><i class="fa fa-heart"> Return </i></div>
                                </a>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="col-md-6">
                <div id="commentsWrapper" class="wrapper" style="margin-left:100px;">
                    <?php foreach ($comments as $key => $comment): ?>
                        <div class="contain" style="width:800px;">
                            <div class="card" style="width: 90%;height:100%;margin-bottom:10px;border-radius:20px">
                                <div class="d-flex justify-content-between p-2 px-3">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="/animal_php/view/design/Footer/nekoparalogo.png" class="rounded-circle"
                                            style="height:75px;width:100px;">
                                        <div class="d-flex flex-column ml-2"
                                            style="margin-left:10px;margin-top:15px;">
                                            <span class="font-weight-bold"><?= htmlspecialchars($comment['username']) ?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row mt-1 ellipsis">
                                        <small class="mr-2" style="margin-top:10px"><?= htmlspecialchars($comment['date_time']) ?></small>
                                    </div>
                                </div>
                                <div class="p-2" style="text-align:left;margin-left:70px">
                                    <p class="text-justify"><?= htmlspecialchars($comment['chat_data']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Add Comment Form -->
                <form action="/animal_php/view/post/add-comment.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post_id) ?>" />
                    <div class="d-flex" style="margin-top: 75px;margin-left:100px;">
                        <textarea class="form-control textbox" name="chatData" required rows="2"
                            cols="80" style="border-radius: 20px;overflow-x: hidden;"></textarea>
                        <button type="submit" class="btn btn-primary" style="width: 100px; height: 50px;margin-left:10px;">Enter</button>
                    </div>
                </form>
            </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const postId = <?= json_encode($post_id) ?>; // Pass the post ID to JavaScript

    // Function to fetch and update comments
    function fetchComments() {
    fetch(`/animal_php/view/post/fetch-comments.php?post_id=${postId}`)
        .then(response => response.json())
        .then(comments => {
            const commentsWrapper = document.getElementById('commentsWrapper');
            commentsWrapper.innerHTML = ''; // Clear existing comments

            comments.forEach(comment => {
                const commentHtml = `
                    <div class="contain" style="width:800px;">
                        <div class="card" style="width: 90%;height:100%;margin-bottom:10px;border-radius:20px">
                            <div class="d-flex justify-content-between p-2 px-3">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="/animal_php/view/design/Footer/nekoparalogo.png" class="rounded-circle"
                                        style="height:75px;width:100px;">
                                    <div class="d-flex flex-column ml-2"
                                        style="margin-left:10px;margin-top:15px;">
                                        <span class="font-weight-bold">${comment.username}</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-1 ellipsis">
                                    <small class="mr-2" style="margin-top:10px">${comment.date_time}</small>
                                </div>
                            </div>
                            <div class="p-2" style="text-align:left;margin-left:70px">
                                <p class="text-justify">${comment.chat_data}</p>
                            </div>
                        </div>
                    </div>
                `;
                commentsWrapper.innerHTML += commentHtml;
            });

            // Scroll to the bottom of the comments section
            commentsWrapper.scrollTop = commentsWrapper.scrollHeight;
        })
        .catch(error => console.error('Error fetching comments:', error));
}

    // Fetch comments every 5 seconds
    setInterval(fetchComments, 500);

    // Fetch comments on page load
    fetchComments();
</script>
<script>
    const commentForm = document.querySelector('form.needs-validation');

    commentForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(commentForm);

        fetch('/animal_php/view/post/add-comment.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    commentForm.reset(); // Clear the form
                    fetchComments(); // Refresh comments
                } else {
                    alert(data.error || 'Failed to add comment');
                }
            })
            .catch(error => console.error('Error adding comment:', error));
    });
</script>
</html>