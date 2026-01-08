<?php 

class Checkout extends Controller {
    public function __construct() {
        // Proteksi: User harus login untuk akses keranjang
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Keranjang Belanja';
        $data['keranjang'] = $this->model('Makanan_model')->getKeranjang();
        
        $this->view('templates/header', $data);
        $this->view('checkout/index', $data);
        $this->view('templates/footer');
    }

    public function tambah($id) {
        if ($this->model('Makanan_model')->tambahKeKeranjang($id) > 0) {
            // Berhasil tambah ke keranjang
            header('Location: ' . BASEURL . '/checkout');
            exit;
        } else {
            // Jika gagal tambah
            header('Location: ' . BASEURL . '/makanan');
            exit;
        }
    }

    public function hapus($id) {
        // Menghapus satu item spesifik dari keranjang
        if ($this->model('Makanan_model')->hapusItemKeranjang($id) > 0) {
            header('Location: ' . BASEURL . '/checkout');
            exit;
        } else {
            header('Location: ' . BASEURL . '/checkout');
            exit;
        }
    }

    public function bayar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Validasi: Pastikan total bayar tidak nol
            if ($_POST['total_bayar'] <= 0) {
                echo "<script>alert('Keranjang Anda kosong!'); window.location='".BASEURL."/makanan';</script>";
                exit;
            }

            // 2. Memproses data ke tabel pesanan dan mengosongkan keranjang melalui model
            $id_nota = $this->model('Makanan_model')->prosesBayar($_POST);
            
            if ($id_nota) {
                // Jika sukses, arahkan ke halaman struk membawa ID Nota
                header('Location: ' . BASEURL . '/checkout/struk/' . $id_nota);
                exit;
            } else {
                // Jika gagal (Misal: Error Database)
                echo "<script>alert('Terjadi kesalahan pada database saat memproses pembayaran.'); window.location='".BASEURL."/checkout';</script>";
                exit;
            }
        } else {
            // Jika mencoba akses method bayar tanpa POST
            header('Location: ' . BASEURL . '/checkout');
            exit;
        }
    }

    public function struk($id) {
        $data['judul'] = 'Nota Pembayaran';
        $data['id_nota'] = $id;
        
        // Ambil detail pesanan jika diperlukan untuk struk yang lebih detil
        // $data['pesanan'] = $this->model('Makanan_model')->getPesananById($id);

        $this->view('templates/header', $data);
        $this->view('checkout/struk', $data);
        $this->view('templates/footer');
    }
}