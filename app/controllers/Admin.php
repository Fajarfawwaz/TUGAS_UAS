<?php 
class Admin extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Admin';
        $data['menu'] = $this->model('Makanan_model')->getSemuaMenuAdmin();
        $data['riwayat'] = $this->model('Makanan_model')->getRiwayatTransaksi();
        
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Makanan_model')->tambahDataMenu($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }
    }

    public function hapus($id) {
        if ($this->model('Makanan_model')->hapusDataMenu($id) > 0) {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }
    }
}