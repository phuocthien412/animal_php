<?php
class ClassAnimal {
    private $id_class;
    private $background_video;
    private $info;
    private $name;

    // Getters and setters for each property
    public function getIdClass() {
        return $this->id_class;
    }

    public function setIdClass($id_class) {
        $this->id_class = $id_class;
    }

    public function getBackgroundVideo() {
        return $this->background_video;
    }

    public function setBackgroundVideo($background_video) {
        $this->background_video = $background_video;
    }

    public function getInfo() {
        return $this->info;
    }

    public function setInfo($info) {
        $this->info = $info;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
?>