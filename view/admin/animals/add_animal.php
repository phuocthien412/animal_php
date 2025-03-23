<?php
require_once '../../../controller/AnimalController.php';
require_once '../../../controller/ClassAnimalController.php';
require_once '../../../controller/ListAnimalController.php'; // Include the controller for list images

// Fetch the list of class animals
$classAnimalController = new ClassAnimalController();
$classAnimals = $classAnimalController->getAllClassAnimals();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'gioi_thieu_text' => $_POST['gioi_thieu_text'],
        'ngoai_hinh_text' => $_POST['ngoai_hinh_text'],
        'noi_sinh_song_text' => $_POST['noi_sinh_song_text'],
        'avatar' => $_FILES['avatar']['name'], // Handle file upload
        'noi_sinh_song_image' => $_FILES['noi_sinh_song_image']['name'], // Handle file upload
        'imgqr3d' => $_FILES['imgqr3d']['name'], // Handle file upload
        'classanimals_id' => $_POST['classanimals_id'] // Save the selected class animal ID
    ];

    // Handle file uploads
    $uploadDir = '../../../images/';
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $_FILES['avatar']['name']);
    move_uploaded_file($_FILES['noi_sinh_song_image']['tmp_name'], $uploadDir . $_FILES['noi_sinh_song_image']['name']);
    move_uploaded_file($_FILES['imgqr3d']['tmp_name'], $uploadDir . $_FILES['imgqr3d']['name']);

    // Add the animal to the database
    $animalController = new AnimalController();
    $animalId = $animalController->createAnimal($data); // Get the ID of the newly created animal

    // Handle multiple images from a single input file for the list_image table
    $listAnimalController = new ListAnimalController();
    if (!empty($_FILES['list_images']['name'][0])) {
        foreach ($_FILES['list_images']['name'] as $key => $imageName) {
            $tmpName = $_FILES['list_images']['tmp_name'][$key];
            $imagePath = $uploadDir . $imageName;
            if (move_uploaded_file($tmpName, $imagePath)) {
                $listAnimalController->addImage([
                    'animalimage' => $imageName, // Store only the image name
                    'animals_id' => $animalId   // Use the correct animal ID
                ]);
            }
        }
    }

    // Redirect to the animal list page after successful submission
    header("Location: /animal_php/admin/animals");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm động vật</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0 auto;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .preview-images img {
            max-width: 100px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function previewImages(input, previewContainerId) {
            const previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = ''; // Clear previous previews
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Preview';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</head>
<body>
    <?php include '../../headerAdmin.php'; ?>
    <div class="form-container">
        <h2>Thêm động vật</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Động vật đã được thêm thành công!</div>
        <?php endif; ?>
        <form action="/animal_php/admin/animals/add" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="gioi_thieu_text">Giới thiệu:</label>
                <textarea class="form-control" id="gioi_thieu_text" name="gioi_thieu_text" required></textarea>
            </div>
            <div class="form-group">
                <label for="ngoai_hinh_text">Ngoại hình:</label>
                <textarea class="form-control" id="ngoai_hinh_text" name="ngoai_hinh_text" required></textarea>
            </div>
            <div class="form-group">
                <label for="noi_sinh_song_text">Nơi sinh sống:</label>
                <textarea class="form-control" id="noi_sinh_song_text" name="noi_sinh_song_text" required></textarea>
            </div>
            <div class="form-group">
                <label for="avatar">Hình ảnh đại diện:</label>
                <input type="file" class="form-control" id="avatar" name="avatar" required onchange="previewImage(this, 'avatarPreview')">
                <img id="avatarPreview" style="display:none; margin-top:10px; width:200px" alt="Avatar Preview">
            </div>
            <div class="form-group">
                <label for="noi_sinh_song_image">Hình ảnh nơi sinh sống:</label>
                <input type="file" class="form-control" id="noi_sinh_song_image" name="noi_sinh_song_image" required onchange="previewImage(this, 'habitatPreview')">
                <img id="habitatPreview" style="display:none; margin-top:10px; width:200px" alt="Habitat Preview">
            </div>
            <div class="form-group">
                <label for="imgqr3d">Hình ảnh QR 3D:</label>
                <input type="file" class="form-control" id="imgqr3d" name="imgqr3d" required onchange="previewImage(this, 'qrPreview')">
                <img id="qrPreview" style="display:none; margin-top:10px; width:200px" alt="QR Preview">
            </div>
            <div class="form-group">
                <label for="list_images">Hình ảnh phụ (tối đa 3):</label>
                <input type="file" class="form-control" id="list_images" name="list_images[]" multiple onchange="previewImages(this, 'previewContainer')">
                <div id="previewContainer" class="preview-images"></div>
            </div>
            <div class="form-group">
                <label for="classanimals_id">Class Animal:</label>
                <select class="form-control" id="classanimals_id" name="classanimals_id" required>
                    <option value="" disabled selected>Chọn Class Animal</option>
                    <?php foreach ($classAnimals as $classAnimal): ?>
                        <option value="<?= htmlspecialchars($classAnimal['id_class']) ?>">
                            <?= htmlspecialchars($classAnimal['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Thêm</button>
        </form>
    </div>
</body>
</html>