<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Post.php';

class PostController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new post
    public function createPost($data) {
        // Check if user_id exists
        $sql = "SELECT COUNT(*) FROM user WHERE id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $data['user_id']]);
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("User ID does not exist.");
        }

        $sql = "INSERT INTO posts (date, image, title, user_id) VALUES (:date, :image, :title, :user_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all posts
    public function getAllPosts() {
        $sql = "SELECT * FROM posts";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single post by ID
    public function getPostById($id_post) {
        $sql = "SELECT * FROM posts WHERE id_post = :id_post";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_post' => $id_post]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing post
    public function updatePost($id_post, $data) {
        $sql = "UPDATE posts SET date = :date, image = :image, title = :title, user_id = :user_id WHERE id_post = :id_post";
        $stmt = $this->db->prepare($sql);
        $data['id_post'] = $id_post;
        return $stmt->execute($data);
    }

    // Delete a post
    public function deletePost($id_post) {
        $sql = "DELETE FROM posts WHERE id_post = :id_post";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id_post' => $id_post]);
    }
}
?>