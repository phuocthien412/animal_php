<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/User.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new user
    public function createUser($data) {
        $sql = "INSERT INTO user (email, password, phone, provider, username) 
                VALUES (:email, :password, :phone, :provider, :username)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute($data);
            $userId = $this->db->lastInsertId();

            // Assign roles to the user
            if (!empty($data['roles'])) {
                foreach ($data['roles'] as $roleId) {
                    $this->assignRoleToUser($userId, $roleId);
                }
            }

            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry error code
                return 'duplicate';
            } else {
                throw $e;
            }
        }
    }

    // Assign a role to a user
    public function assignRoleToUser($userId, $roleId) {
        $sql = "INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['user_id' => $userId, 'role_id' => $roleId]);
    }

    // Delete roles for a user
    public function deleteUserRoles($userId) {
        $sql = "DELETE FROM user_role WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['user_id' => $userId]);
    }

    // Read all users
    public function getAllUsers() {
        $sql = "SELECT * FROM user";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single user by ID
    public function getUserById($id) {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing user
    public function updateUser($id, $data) {
        $sql = "UPDATE user SET email = :email, phone = :phone, provider = :provider, username = :username";
        if (isset($data['password'])) {
            $sql .= ", password = :password";
        }
        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a user
    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Get roles for a user
    public function getUserRoles($userId) {
        $sql = "SELECT r.* FROM role r
                INNER JOIN user_role ur ON r.id = ur.role_id
                WHERE ur.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>