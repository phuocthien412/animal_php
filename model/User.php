<?php
class User {
    private $id;
    private $email;
    private $password;
    private $phone;
    private $provider;
    private $username;

    // Getters and setters for each property
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getProvider() {
        return $this->provider;
    }

    public function setProvider($provider) {
        $this->provider = $provider;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
}
?>