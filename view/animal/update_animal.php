<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../controller/AnimalController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'gioi_thieu_text' => $_POST['gioi_thieu_text'],
        'ngoai_hinh_text' => $_POST['ngoai_hinh_text'],
        'noi_sinh_song_text' => $_POST['noi_sinh_song_text'],
        'avatar' => $_POST['avatar'],
        'noi_sinh_song_image' => $_POST['noi_sinh_song_image'],
        'imgqr3d' => $_POST['imgqr3d'],
        'classanimals_id' => $_POST['classanimals_id']
    ];

    $animalController = new AnimalController();
    $animalController->updateAnimal($id, $data);

    header("Location: ../../index.php");
    exit();
}
?>