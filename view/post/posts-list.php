<?php

require_once '../../controller/PostController.php';
require_once '../../controller/UserController.php';

$postController = new PostController();
$userController = new UserController();

include '../header.php';
// Get the logged-in user's ID
$loggedInUserId = $_SESSION['user_id'];

// Check if "Show My Posts" is enabled
$showOnlyMyPosts = isset($_GET['showOnlyMyPosts']) && $_GET['showOnlyMyPosts'] === 'true';

if ($showOnlyMyPosts) {
    // Filter posts where the user_id matches the logged-in user's ID
    $posts = array_filter($postController->getAllPosts(), function ($post) use ($loggedInUserId) {
        return $post['user_id'] === $loggedInUserId;
    });
} else {
    // Fetch all posts
    $posts = $postController->getAllPosts();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="stylesheet" href="/animal_php/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/animal_php/css/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page using JavaScript
        echo '<script>window.location.href = "/animal_php/view/user/login.php";</script>';
        exit();
    }
    ?>
    <section layout:fragment="content" style="padding: 0;">
        <section class="Post">
            <img src="/animal_php/view/design/ClassAnimal/Background/ca.gif" alt="Background Image" class="classbg" />
            <h1 class="textclassanimalName" style="margin-top:-300px;margin-left: 200px;">Community</h1>
            <h1 class="textclassanimalInfo" style="margin-left:300px;">Hãy cùng nhau chia sẽ những trải nghiệp của bản thân
                về thế
                giới động vật tại đậy và cùng nhau tạo nên một cộng đồng lành mạnh và đầy phát triển.</h1>
            <div class="PostList" style="margin-top: 100px; display: flex; flex-wrap: wrap;">
                <div class="popup" style=" margin-left:800px;">
                    <!-- Trigger/Open The Modal -->
                    <a id="mbtn" class="button" style="margin-top:-80px">
                        <span class="content">Tạo bài viết!</span>
                    </a>
                    <!-- The Modal -->
                    <div id="modalDialog" class="modal">
                        <div class="modal-content animate-top"
                            style="background-image: url('/animal_php/view/design/Explore/bg.png');object-fit: cover;">
                            <div class="modal-header">
                                <b class="modal-title" style="color:white;">Đăng bài viết</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/animal_php/view/post/add.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <b style="color:white;">Post Title:</b>
                                        <input type="text" name="title" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <b style="color:white;">Upload Image:</b>
                                        <input type="file" class="form-control" id="imageFile" name="imageFile" accept="image/*" required onchange="previewImage(event)" />
                                    </div>
                                    <div class="col-md-4">
                                        <img id="imagePreview" class="itemPreview" alt="Image Preview" style="display: none;" />
                                    </div>
                                    <input type="submit" value="Add Post" class="btn btn-primary" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-check" style="margin-left: -800px; font-size: 2rem;margin-top: 100px">
                    <input class="form-check-input" type="checkbox" value="" id="showOnlyMyPosts"
                        <?= isset($_GET['showOnlyMyPosts']) && $_GET['showOnlyMyPosts'] === 'true' ? 'checked' : '' ?>
                        onchange="window.location.href = '/animal_php/view/post/posts-list.php?showOnlyMyPosts=' + this.checked;"
                        style="transform: scale(2); margin-top: 15px">
                    <label class="form-check-label" for="showOnlyMyPosts"
                        style="color: white; -webkit-text-stroke: 1px black; margin-left: 10px;">
                        Show my posts
                    </label>
                </div>
                <div class="list" style="margin-left: 200px; margin-top: 0px; display: flex; flex-wrap: wrap;">
                    <?php foreach ($posts as $post): ?>
                        <?php
                        // Fetch the username for the current post's user_id
                        $username = $userController->getUsernameById($post['user_id']);
                        ?>
                        <a href="/animal_php/posts/detail/<?= htmlspecialchars($post['id_post']) ?>" style="margin-bottom: 120px; margin-right: 50px; text-decoration: none;">
                            <div class="contain" style="width:450px;height:600px;">
                                <div class="card" style="width: 100%;height:100%;">
                                    <div class="d-flex justify-content-between p-2 px-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <img src="/animal_php/view/design/Footer/nekoparalogo.png" width="50" class="rounded-circle" style="height:50px;width:50px;object-fit:cover">
                                            <div class="d-flex flex-column ml-2" style="margin-left:10px">
                                                <span class="font-weight-bold"><?= htmlspecialchars($username) ?></span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row mt-1 ellipsis">
                                            <small class="mr-2" style="margin-top:10px"><?= htmlspecialchars($post['date']) ?></small>
                                        </div>
                                    </div>
                                    <img src="/animal_php/images/<?= htmlspecialchars($post['image']) ?>" class="img-fluid" style="width:100%;height:400px;object-fit:cover;">
                                    <div class="p-2">
                                        <p class="text-justify"><?= htmlspecialchars($post['title']) ?></p>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row icons d-flex align-items-center">
                                                <i class="fa fa-smile-o ml-2"></i>
                                            </div>
                                            <div class="d-flex flex-row muted-color">
                                                <i class="fa fa-heart"> Discuss now!!!</i>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <script>
            function previewImage(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').src = e.target.result;
                        document.getElementById('imagePreview').style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            /*
             * Modal popup
             */
            // Get the modal
            var modal = $('#modalDialog');

            // Get the button that opens the modal
            var btn = $("#mbtn");

            // Get the element that closes the modal
            var span = $(".close");

            $(document).ready(function() {
                // When the user clicks the button, open the modal
                btn.on('click', function() {
                    modal.show();
                });

                // When the user clicks on (x), close the modal
                span.on('click', function() {
                    modal.hide();
                });
            });

            $('body').bind('click', function(e) {
                if ($(e.target).hasClass("modal")) {
                    modal.hide();
                }
            });
        </script>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>