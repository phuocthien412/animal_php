<?php
class Post {
    private $id_post;
    private $date;
    private $image;
    private $title;
    private $user_id;

    // Getters and setters for each property
    public function getIdPost() {
        return $this->id_post;
    }

    public function setIdPost($id_post) {
        $this->id_post = $id_post;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
}
?>