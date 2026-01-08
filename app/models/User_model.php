<?php 

class User_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
        // Otomatis buat tabel dan isi akun default jika belum ada
        $this->siapkanTabelUser();
    }

    private function siapkanTabelUser() {
        // 1. Buat Tabel Users jika belum ada
        $queryTable = "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin', 'user') DEFAULT 'user'
        )";
        $this->db->query($queryTable);

        // 2. Cek apakah tabel kosong? Jika kosong, masukkan akun default
        $check = $this->db->query("SELECT COUNT(*) as total FROM users");
        $row = $check->fetch_assoc();

        if ($row['total'] == 0) {
            $this->db->query("INSERT INTO users (username, password, role) VALUES 
                ('admin', 'admin123', 'admin'),
                ('user', 'user123', 'user')");
        }
    }

    public function cekLogin($username, $password) {
        // Lindungi dari SQL Injection
        $username = $this->db->escape($username);
        $password = $this->db->escape($password);

        // Query cari user berdasarkan username dan password (Plain Text untuk UAS)
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
}