<?php 

class Makanan_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
        // Otomatis siapkan infrastruktur database
        $this->siapkanDatabase();
    }

    /**
     * Memastikan tabel yang dibutuhkan tersedia
     */
    private function siapkanDatabase() {
        // Tabel Pesanan
        $queryPesanan = "CREATE TABLE IF NOT EXISTS pesanan (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nama_pembeli VARCHAR(255) NOT NULL,
            total_harga INT NOT NULL,
            tanggal_pesan DATETIME NOT NULL
        )";
        $this->db->query($queryPesanan);

        // Tabel Keranjang (Menghubungkan menu_id ke menu_makanan)
        $queryKeranjang = "CREATE TABLE IF NOT EXISTS keranjang (
            id INT PRIMARY KEY AUTO_INCREMENT,
            menu_id INT NOT NULL
        )";
        $this->db->query($queryKeranjang);
    }

    // ==========================================
    //          LOGIKA DATA MENU (USER)
    // ==========================================

    /**
     * Mengambil SEMUA menu tanpa limit (Untuk Catalog)
     */
    public function getSemuaMenu() {
        $query = "SELECT * FROM menu_makanan ORDER BY id DESC";
        return $this->db->query($query);
    }

    /**
     * Mengambil menu dengan limit (Untuk Pagination/Fitur Cari)
     */
    public function getAllMenu($start, $limit, $keyword = '') {
        $keyword = $this->db->escape($keyword);
        $query = "SELECT * FROM menu_makanan WHERE nama_menu LIKE '%$keyword%' LIMIT $start, $limit";
        return $this->db->query($query);
    }

    public function getTotalMenu($keyword = '') {
        $keyword = $this->db->escape($keyword);
        $query = "SELECT COUNT(*) as total FROM menu_makanan WHERE nama_menu LIKE '%$keyword%'";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // ==========================================
    //          LOGIKA KERANJANG (USER)
    // ==========================================

    public function tambahKeKeranjang($id_menu) {
        $id_menu = (int)$id_menu;
        $query = "INSERT INTO keranjang (menu_id) VALUES ($id_menu)";
        $this->db->query($query);
        return $this->db->affected_rows();
    }

    public function getKeranjang() {
        $query = "SELECT k.id as id_keranjang, m.nama_menu, m.harga 
                  FROM keranjang k 
                  JOIN menu_makanan m ON k.menu_id = m.id";
        return $this->db->query($query);
    }

    public function hapusItemKeranjang($id) {
        $id = (int)$id;
        $this->db->query("DELETE FROM keranjang WHERE id = $id");
        return $this->db->affected_rows();
    }

    // ==========================================
    //          LOGIKA CHECKOUT & PESANAN
    // ==========================================

    public function prosesBayar($data) {
        $nama_pembeli = $_SESSION['nama_user'] ?? ($_SESSION['username'] ?? 'Pelanggan');
        $total_bayar = isset($data['total_bayar']) ? (int)$data['total_bayar'] : 0;
        $tanggal = date('Y-m-d H:i:s');

        if ($total_bayar <= 0) return false;

        $query = "INSERT INTO pesanan (nama_pembeli, total_harga, tanggal_pesan) 
                  VALUES ('$nama_pembeli', $total_bayar, '$tanggal')";
        
        $exec = $this->db->query($query);
        
        if ($exec) {
            $id_nota = $this->db->insert_id();
            $this->db->query("DELETE FROM keranjang");
            return $id_nota;
        }
        
        return false;
    }

    // ==========================================
    //          LOGIKA KELOLA MENU (ADMIN)
    // ==========================================

    public function getSemuaMenuAdmin() {
        return $this->db->query("SELECT * FROM menu_makanan ORDER BY id DESC");
    }

    public function tambahDataMenu($data) {
        $nama = $this->db->escape($data['nama_menu']);
        $harga = (int)$data['harga'];
        $stok = (int)$data['stok'];
        $kategori = $this->db->escape($data['kategori']);

        $query = "INSERT INTO menu_makanan (nama_menu, harga, stok, kategori) 
                  VALUES ('$nama', $harga, $stok, '$kategori')";
        
        $this->db->query($query);
        return $this->db->affected_rows();
    }

    public function hapusDataMenu($id) {
        $id = (int)$id;
        $this->db->query("DELETE FROM menu_makanan WHERE id = $id");
        return $this->db->affected_rows();
    }

    // ==========================================
    //          LOGIKA RIWAYAT & STATISTIK (ADMIN)
    // ==========================================

    public function getRiwayatTransaksi() {
        return $this->db->query("SELECT * FROM pesanan ORDER BY id DESC");
    }

    public function getStatistik() {
        $res_menu = $this->db->query("SELECT COUNT(*) as total FROM menu_makanan");
        $menu = ($res_menu) ? $res_menu->fetch_assoc() : ['total' => 0];
        
        $res_pesan = $this->db->query("SELECT COUNT(*) as total, SUM(total_harga) as pendapatan FROM pesanan");
        $p = ($res_pesan) ? $res_pesan->fetch_assoc() : ['total' => 0, 'pendapatan' => 0];

        return [
            'total_menu' => $menu['total'],
            'total_pesanan' => $p['total'] ?? 0,
            'pendapatan' => $p['pendapatan'] ?? 0
        ];
    }
}