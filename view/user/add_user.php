<?php
require_once '../../controller/UserController.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'phone' => $_POST['phone'],
        'provider' => '', // Set provider to blank
        'username' => $_POST['username'],
        'roles' => [3] // Assuming '2' is the ID for the 'user' role
    ];

    $userController = new UserController();
    $result = $userController->createUser($data);

    if ($result === 'duplicate_email') {
        $error = 'Email đã tồn tại. Vui lòng sử dụng email khác.';
    } elseif ($result === 'duplicate_phone') {
        $error = 'Số điện thoại đã tồn tại. Vui lòng sử dụng số điện thoại khác.';
    } elseif ($result === 'duplicate_username') {
        $error = 'Tên người dùng đã tồn tại. Vui lòng sử dụng tên người dùng khác.';
    } else {
        // Set session variables for instant login
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['roles'] = $result['roles'];
        header("Location: /animal_php/Home");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<?php
include '../header.php';
?>
<section layout:fragment="content" style="padding: 0;">
<section class="ClassAnimal" style="width:100%;">
    <div class="login-container" style="margin: 0 auto;">
        <h2>Register</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="/animal_php/Register" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group hidden">
                <label for="provider">Provider</label>
                <input type="text" class="form-control" id="provider" name="provider" value="">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group hidden">
                <label for="roles">Roles</label>
                <select class="form-control" id="roles" name="roles[]" multiple>
                    <option value="2" selected>User</option> <!-- Assuming '2' is the ID for the 'user' role -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</section>
</section>
<?php
include '../footer.php';
?>
</body>
</html>