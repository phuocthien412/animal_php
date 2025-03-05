<!-- filepath: /d:/laragon/www/ANIMAL_PHP/view/layout.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>NEKOPARA</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/animal_php/view/design/Home/logo.png" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/animal_php/css/mystyle.css" />
    
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
<footer>
    <div class="row">
        <div class="col-md-6">
            <h1 class="textfooter" style="margin-left: 100px; margin-top: 30px;">CONTACT US!</h1>
            <div class="row align-items-center" style="margin-left: 105px;">
                <div class="col-auto">
                    <img src="/animal_php/view/design/Footer/GmailLogo.png" alt="Gmail Logo">
                </div>
                <div class="col">
                    <h1 class="textfooter" style="font-size: 35px;">nekopara@gmail.com</h1>
                </div>
            </div>
            <div class="row align-items-center" style="margin-left: 100px;">
                <div class="col-auto">
                    <img src="/animal_php/view/design/Footer/FBLogo.png" alt="Gmail Logo" />
                </div>
                <div class="col">
                    <h1 class="textfooter" style="font-size: 35px;">facebook.com/NEKOPARA</h1>
                </div>
            </div>
            <div class="row align-items-center" style="margin-left: 100px;">
                <div class="col">
                    <h1 class="textfooter" style="font-size: 25px;">
                        © 2025 All Rights Reserved | Nekopara.com
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="row">
                <div class="col-md-6">
                    <img src="/animal_php/view/design/Footer/wwflogo.png" alt="Logo" style="margin-right: -50px; margin-bottom: -200px;">
                </div>
                <div class="col-md-6">
                    <img src="/animal_php/view/design/Footer/nekoparalogo.png" alt="Logo">
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let inputBox = document.querySelector(".input-box"),
        searchIcon = document.querySelector(".icon"),
        closeIcon = document.querySelector(".close-icon");
    searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
    closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>