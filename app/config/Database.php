<?php
class Database {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect('localhost', 'root', '', 'htlx');
        if (!$this->conn) {
            die('Không kết nối được Database: ' . mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, 'utf8');
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
