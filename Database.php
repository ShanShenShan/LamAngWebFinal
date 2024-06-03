<?php
class Database {
    private $host = "localhost";
    private $db_name = "lamang";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class Feedback {
    private $conn;
    private $table_name = "feedback";

    public $id;
    public $name;
    public $phone;
    public $email;
    public $msg;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, phone, email, msg) VALUES (:name, :phone, :email, :msg)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':msg', $this->msg);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
