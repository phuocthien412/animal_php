<?php
class Animal {
    private $id_animal;
    private $avatar;
    private $gioi_thieu_text;
    private $imgqr3d;
    private $ngoai_hinh_text;
    private $noi_sinh_song_image;
    private $noi_sinh_song_text;
    private $name;
    private $classanimals_id;

    public function __construct() {
        // Constructor logic if needed
    }

    // Getters and setters for each property
    public function getIdAnimal() {
        return $this->id_animal;
    }

    public function setIdAnimal($id_animal) {
        $this->id_animal = $id_animal;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function getGioiThieuText() {
        return $this->gioi_thieu_text;
    }

    public function setGioiThieuText($gioi_thieu_text) {
        $this->gioi_thieu_text = $gioi_thieu_text;
    }

    public function getImgqr3d() {
        return $this->imgqr3d;
    }

    public function setImgqr3d($imgqr3d) {
        $this->imgqr3d = $imgqr3d;
    }

    public function getNgoaiHinhText() {
        return $this->ngoai_hinh_text;
    }

    public function setNgoaiHinhText($ngoai_hinh_text) {
        $this->ngoai_hinh_text = $ngoai_hinh_text;
    }

    public function getNoiSinhSongImage() {
        return $this->noi_sinh_song_image;
    }

    public function setNoiSinhSongImage($noi_sinh_song_image) {
        $this->noi_sinh_song_image = $noi_sinh_song_image;
    }

    public function getNoiSinhSongText() {
        return $this->noi_sinh_song_text;
    }

    public function setNoiSinhSongText($noi_sinh_song_text) {
        $this->noi_sinh_song_text = $noi_sinh_song_text;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getClassanimalsId() {
        return $this->classanimals_id;
    }

    public function setClassanimalsId($classanimals_id) {
        $this->classanimals_id = $classanimals_id;
    }
}
?>