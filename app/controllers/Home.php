<?php 

class Home extends Controller {
    public function index() {
        $data['judul'] = 'Halaman Utama';
        
        // Memanggil View agar tampilan berubah dari teks polos menjadi desain Bootstrap
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}