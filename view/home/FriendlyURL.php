<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/animal_php/home':
        include '../view/home/index.php';
        break;
    // Thêm các trường hợp khác cho các trang khác
    default:
        include '../view/FriendlyURL.php'; // Trang lỗi 404
        break;
}
?>