<?php
class Comment {
    private $id_cmt;
    private $chat_data;
    private $date_time;
    private $post_id;
    private $user_id;

    // Getters and setters for each property
    public function getIdCmt() {
        return $this->id_cmt;
    }

    public function setIdCmt($id_cmt) {
        $this->id_cmt = $id_cmt;
    }

    public function getChatData() {
        return $this->chat_data;
    }

    public function setChatData($chat_data) {
        $this->chat_data = $chat_data;
    }

    public function getDateTime() {
        return $this->date_time;
    }

    public function setDateTime($date_time) {
        $this->date_time = $date_time;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    // Validation methods
    public function validateIdCmt() {
        return is_numeric($this->id_cmt) && $this->id_cmt > 0;
    }

    public function validateChatData() {
        return !empty($this->chat_data) && strlen($this->chat_data) <= 255;
    }

    public function validateDateTime() {
        return (bool)strtotime($this->date_time);
    }

    public function validatePostId() {
        return is_numeric($this->post_id) && $this->post_id > 0;
    }

    public function validateUserId() {
        return is_numeric($this->user_id) && $this->user_id > 0;
    }

    public function validate() {
        return $this->validateIdCmt() &&
               $this->validateChatData() &&
               $this->validateDateTime() &&
               $this->validatePostId() &&
               $this->validateUserId();
    }
}
?>