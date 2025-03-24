<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Comment.php';

class CommentController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new comment
    public function createComment($data) {
        $sql = "INSERT INTO comments (chat_data, date_time, post_id, user_id) VALUES (:chat_data, :date_time, :post_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all comments
    public function getAllComments() {
        $sql = "SELECT * FROM comments";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single comment by ID
    public function getCommentById($id_cmt) {
        $sql = "SELECT * FROM comments WHERE id_cmt = :id_cmt";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_cmt' => $id_cmt]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing comment
    public function updateComment($id_cmt, $data) {
        $sql = "UPDATE comments SET chat_data = :chat_data, date_time = :date_time, post_id = :post_id, user_id = :user_id WHERE id_cmt = :id_cmt";
        $stmt = $this->db->prepare($sql);
        $data['id_cmt'] = $id_cmt;
        return $stmt->execute($data);
    }

    // Delete a comment
    public function deleteComment($id_cmt) {
        $sql = "DELETE FROM comments WHERE id_cmt = :id_cmt";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cmt', $id_cmt, PDO::PARAM_INT);
    
        if (!$stmt->execute()) {
            throw new Exception("Error deleting comment: " . implode(", ", $stmt->errorInfo()));
        }
    }
    public function getCommentsByPostId($post_id) {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY date_time ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['post_id' => $post_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addComment($post_id, $user_id, $chat_data) {
        $sql = "INSERT INTO comments (post_id, user_id, chat_data, date_time) VALUES (:post_id, :user_id, :chat_data, NOW())";
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':chat_data', $chat_data, PDO::PARAM_STR);
    
        if (!$stmt->execute()) {
            throw new Exception("Error adding comment: " . implode(", ", $stmt->errorInfo()));
        }
    }
}
?>