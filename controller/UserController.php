<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/UserRole.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function loginUser($username, $password) {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $user['roles'] = $this->getUserRoles($user['id']);
            return $user;
        } else {
            return false;
        }
    }
    
    // Create a new user
    public function createUser($data) {
        // Check for duplicate email
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $data['email']]);
        if ($stmt->fetchColumn() > 0) {
            return 'duplicate_email';
        }
    
        // Check for duplicate phone number
        $sql = "SELECT COUNT(*) FROM user WHERE phone = :phone";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['phone' => $data['phone']]);
        if ($stmt->fetchColumn() > 0) {
            return 'duplicate_phone';
        }
    
        // Check for duplicate username
        $sql = "SELECT COUNT(*) FROM user WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $data['username']]);
        if ($stmt->fetchColumn() > 0) {
            return 'duplicate_username';
        }
    
        // Insert new user
        $sql = "INSERT INTO user (email, password, phone, provider, username) 
                VALUES (:email, :password, :phone, :provider, :username)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                'email' => $data['email'],
                'password' => $data['password'],
                'phone' => $data['phone'],
                'provider' => $data['provider'],
                'username' => $data['username']
            ]);
            $userId = $this->db->lastInsertId();
    
            // Assign the default role (user) to the new user
            $roleId = 3; // Assuming '2' is the ID for the 'user' role
            $sql = "INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'user_id' => $userId,
                'role_id' => $roleId
            ]);
    
            // Return user data for session
            return [
                'id' => $userId,
                'username' => $data['username'],
                'roles' => ['user'] // Assuming 'user' is the role name
            ];
        } catch (PDOException $e) {
            throw $e;
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
        $sql = "SELECT u.id, u.username, r.name AS role_name
                FROM user u
                LEFT JOIN user_role ur ON u.id = ur.user_id
                LEFT JOIN role r ON ur.role_id = r.id
                WHERE u.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!$rows) {
            return null;
        }
    
        $user = [
            'id' => $rows[0]['id'],
            'username' => $rows[0]['username'],
            'roles' => []
        ];
    
        foreach ($rows as $row) {
            if ($row['role_name']) {
                $user['roles'][] = $row['role_name'];
            }
        }
    
        return $user;
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
        // Delete the user's roles first to maintain referential integrity
        $sql = "DELETE FROM user_role WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    
        // Delete the user
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Get roles for a user
    private function getUserRoles($userId) {
        $sql = "SELECT r.name FROM role r
                JOIN user_role ur ON r.id = ur.role_id
                WHERE ur.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getAllUsersWithRoles() {
        $sql = "SELECT u.id, u.username, u.email, r.name AS role_name
                FROM user u
                LEFT JOIN user_role ur ON u.id = ur.user_id
                LEFT JOIN role r ON ur.role_id = r.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Group roles by user
        $users = [];
        foreach ($rows as $row) {
            $userId = $row['id'];
            if (!isset($users[$userId])) {
                $users[$userId] = [
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'roles' => []
                ];
            }
            if ($row['role_name']) {
                $users[$userId]['roles'][] = $row['role_name'];
            }
        }
    
        return array_values($users);
    }
    public function updateUserRoles($userId, $roles) {
        // Delete existing roles for the user
        $sql = "DELETE FROM user_role WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
    
        // Insert new roles
        $sql = "INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)";
        $stmt = $this->db->prepare($sql);
        foreach ($roles as $roleId) {
            $stmt->execute(['user_id' => $userId, 'role_id' => $roleId]);
        }
    
        return true;
    }
    public function getUsernameById($user_id) {
        $sql = "SELECT username FROM user WHERE id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchColumn(); // Return the username
    }
    
}
?>