<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/Role.php';

class RoleController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create a new role
    public function createRole($data) {
        $sql = "INSERT INTO role (description, name) VALUES (:description, :name)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Read all roles
    public function getAllRoles() {
        $sql = "SELECT * FROM role";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single role by ID
    public function getRoleById($id) {
        $sql = "SELECT * FROM role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing role
    public function updateRole($id, $data) {
        $sql = "UPDATE role SET description = :description, name = :name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a role
    public function deleteRole($id) {
        $sql = "DELETE FROM role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>