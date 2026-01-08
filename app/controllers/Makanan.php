<?php 

class Makanan extends Controller {

    public function __construct() {
        // 1. Cek apakah user sudah login
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
        
        // 2. PROTEKSI ROLE: Hanya 'user' yang boleh akses
        if ($_SESSION['role'] !== 'user') {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Daftar Menu KulinerKu';

        // --- LOGIKA PENCARIAN (SEARCH) ---
        $keyword = "";
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $_SESSION['keyword_makanan'] = $keyword;
        } else if (isset($_SESSION['keyword_makanan'])) {
            $keyword = $_SESSION['keyword_makanan'];
        }

        // --- KONFIGURASI PAGINATION ---
        $jumlahDataPerHalaman = 6;
        $data['halamanAktif'] = (isset($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
        if ($data['halamanAktif'] <= 0) $data['halamanAktif'] = 1;

        $start = ($jumlahDataPerHalaman * $data['halamanAktif']) - $jumlahDataPerHalaman;

        // --- AMBIL DATA DARI MODEL ---
        // Mengambil data menu berdasarkan keyword (jika ada) dan limit pagination
        $data['menu'] = $this->model('Makanan_model')->getAllMenu($start, $jumlahDataPerHalaman, $keyword);
        
        // Hitung total data untuk pagination
        $totalData = $this->model('Makanan_model')->getTotalMenu($keyword);
        $data['jumlahHalaman'] = ceil($totalData / $jumlahDataPerHalaman);

        // --- LOAD VIEWS ---
        $this->view('templates/header', $data);
        $this->view('makanan/index', $data);
        $this->view('templates/footer');
    }

    // Fungsi untuk mereset pencarian agar kembali menampilkan semua menu
    public function reset() {
        unset($_SESSION['keyword_makanan']);
        header('Location: ' . BASEURL . '/makanan');
        exit;
    }
}