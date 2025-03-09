<!-- filepath: /d:/laragon/www/ANIMAL_PHP/view/layout.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>NEKOPARA</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../design/Home/logo.png" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .textheader {
            color: #333;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .textheader:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .textheader.active {
            background-color: #007bff;
            color: white;
        }

        /* Thêm style cho navbar */
        .navbar {
            padding: 15px 0;
            background-color: #F7F7F7 !important;
        }

        .navbar-brand img {
            height: 80px;
            width: auto;
        }

        .nav-item {
            margin: 0 5px;
        }

        /* Style cho form tìm kiếm */
        .input-box {
            position: relative;
            height: 40px;
            max-width: 300px;
            margin: 0 20px;
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .input-box input {
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 25px;
            background: #fff;
            padding: 0 50px 0 20px;
            border: none;
            outline: none;
        }

        .input-box .icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light border-bottom box-shadow mb-3" style="background-color:#F7F7F7;">
        <div class="container-fluid" style="margin-left:100px">
            <a class="navbar-brand" href="../index.php">
                <div class="logo">
                    <img src="/animal_php/view/design/Header/logo.png" width="120px" height="80px">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a class="textheader <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" 
                           href="/animal_php/Home">Trang chủ</a>
                    </li>
                    <li class="nav-item" style="margin-left:10px">
                        <a class="textheader <?php echo (strpos($_SERVER['PHP_SELF'], 'list_classanimals.php') !== false) ? 'active' : ''; ?>" 
                           href="/animal_php/ClassAnimal">Các Lớp động vật</a>
                    </li>
                    <li class="nav-item" style="margin-left:10px">
                        <a class="textheader <?php echo (basename($_SERVER['PHP_SELF']) == 'findanimal.php') ? 'active' : ''; ?>" 
                           href="/animal_php/FindAnimal">Tìm kiếm bằng hình ảnh</a>
                    </li>
                    <li class="nav-item" style="margin-left:10px">
                        <a class="textheader <?php echo (basename($_SERVER['PHP_SELF']) == 'posts.php') ? 'active' : ''; ?>" 
                           href="posts.php">Cộng đồng</a>
                    </li>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item" style="margin-left:10px">
                        <a class="textheader <?php echo (strpos($_SERVER['PHP_SELF'], 'classanimal/admin.php') !== false) ? 'active' : ''; ?>" 
                           href="classanimal/admin.php">Quản trị</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item d-flex align-items-center">
                        <?php if(isset($_SESSION['username'])): ?>
                            <span class="navbar-text">
                                Xin chào, <span class="fw-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </span>
                            <form action="../logout.php" method="post" class="ms-3">
                                <button class="btn btn-outline-danger" type="submit">Đăng xuất</button>
                            </form>
                        <?php else: ?>
                            <a class="btn btn-outline-primary" href="../login.php">Đăng nhập</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <form action="../search.php" method="get" class="input-box" id="searchForm">
                <input type="text" name="searchQuery" id="searchTerm" placeholder="What animal are you looking for?" class="form-control">
                <span class="icon">
                    <i class="uil uil-search search-icon"></i>
                </span>
                <i class="uil uil-times close-icon"></i>
            </form>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#searchForm').submit(function (event) {
                        event.preventDefault(); // Ngăn chặn gửi form mặc định

                        var searchTerm = $('#searchTerm').val(); // Lấy giá trị từ ô nhập liệu

                        // Kiểm tra xem từ khóa tìm kiếm có tồn tại không trước khi gửi form
                        if (searchTerm.trim() !== '') {
                            $(this).unbind('submit').submit(); // Gửi form
                        } else {
                            // Xử lý khi không có từ khóa tìm kiếm
                            // Ví dụ: Hiển thị thông báo lỗi
                            console.log('Vui lòng nhập từ khóa tìm kiếm!');
                        }
                    });
                });
            </script>
        </div>
    </nav>
</header>
</html>