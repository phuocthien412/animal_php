<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">

    <style>
        /* Copy styles từ layout.php */
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

        /* Navbar styles */
        .navbar {
            padding: 15px 0;
            background-color: #F7F7F7 !important;
        }

        .navbar-brand img {
            height: 80px;
            width: auto;
        }

        /* Search box styles */
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

        /* FindAnimal specific styles */
        .ClassAnimal {
            position: relative;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .classbg {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .upload-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .static-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1000;
        }

        .static-button img {
            width: 300px;
            height: 250px;
            border-radius: 30%;
        }

        .click-me {
            color: white;
            font-size: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .search-btn {
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #007bff;
        }

        .search-btn:hover {
            color: #0056b3;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<?php
// filepath: /e:/laragon/www/animal_php/view/home/index.php

// Include the header part of the layout
include '../header.php';
?>
    <!-- Main Content -->
    <section class="ClassAnimal">
        <img src="../design/ClassAnimal/Background/chim.gif" alt="Background" class="classbg" />
        
        <div class="upload-section">
            <h2 class="mb-4">Tìm Kiếm Động Vật Bằng Hình Ảnh</h2>
            <p class="mb-3">Tải lên hình ảnh động vật bạn muốn tìm kiếm thông tin</p>
            
            <input type="file" id="image-upload" class="form-control mb-3" accept="image/*">
            <div id="image-container"></div>
            <div id="label-container"></div>
            <button type="button" onclick="predict()" class="btn btn-primary mt-3">
                <i class="fas fa-search me-2"></i>Tìm Kiếm
            </button>
        </div>

        <div class="static-button" id="startIntro">
            <img src="../../images/idle.gif" alt="Trợ giúp">
            <div class="click-me">Bạn cần trợ giúp?</div>
        </div>
    </section>

    <!-- Footer -->
    <?php
// filepath: /e:/laragon/www/animal_php/view/home/index.php

// Include the header part of the layout
include '../footer.php';
?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript">
        // Model loading and prediction code
        const URL = "../AnimalPredict/";
        let model, imageContainer, labelContainer, maxPredictions;

        async function start() {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            imageContainer = document.getElementById("image-container");
            labelContainer = document.getElementById("label-container");

            const imageUpload = document.getElementById("image-upload");
            imageUpload.addEventListener("change", onImageUpload);
        }

        // ... rest of your JavaScript code ...

        // Search box functionality
        let inputBox = document.querySelector(".input-box"),
            searchIcon = document.querySelector(".icon"),
            closeIcon = document.querySelector(".close-icon");
        
        searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
        closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));

        // Initialize
        start();
    </script>
</body>
</html>