<?php
class Database {
    private $host = "localhost";
    private $db_name = "doanltw";  // Thay bằng tên database của bạn
    private $username = "root";      // Thay bằng username database của bạn
    private $password = "";          // Nếu có mật khẩu, hãy điền vào
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
