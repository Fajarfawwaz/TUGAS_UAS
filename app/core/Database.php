<?php 

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $conn;

    public function __construct() {
        // Koneksi ke MySQL
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

        // Cek jika koneksi gagal
        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
    }

    // Fungsi Query yang dipakai di Model
    public function query($query) {
        return $this->conn->query($query);
    }

    // Fungsi Escape String (Penting untuk Fitur Cari agar tidak error)
    public function escape($data) {
        return $this->conn->real_escape_string($data);
    }

    // Menghitung baris yang terpengaruh (Penting untuk proses Tambah/Hapus)
    public function affected_rows() {
        return $this->conn->affected_rows;
    }

    /**
     * Mengambil ID terakhir yang dimasukkan (PENTING untuk Struk Checkout)
     * Ditambahkan untuk memperbaiki error: Call to undefined method Database::insert_id()
     */
    public function insert_id() {
        return $this->conn->insert_id;
    }
}