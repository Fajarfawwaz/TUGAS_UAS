<?php 

class Auth extends Controller {

    public function index() {
        // Jika sudah login, cegah masuk kembali ke halaman login
        if (isset($_SESSION['login'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/makanan');
            }
            exit;
        }

        $data['judul'] = 'Login KulinerKu';
        
        // Menangkap pesan error jika ada
        $data['error'] = isset($_GET['pesan']) ? $_GET['pesan'] : null;

        $this->view('auth/index', $data); // Pastikan nama file view sesuai (index.php atau login.php)
    }

    public function login() {
        // Pastikan data dikirim via POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->model('User_model')->cekLogin($username, $password);

            if ($user) {
                // SET SESSION
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = strtolower($user['role']);

                // REDIRECT BERDASARKAN ROLE
                if ($_SESSION['role'] == 'admin') {
                    header('Location: ' . BASEURL . '/admin');
                } else {
                    header('Location: ' . BASEURL . '/makanan');
                }
                exit;
            } else {
                // Jika gagal, kembali ke halaman login dengan alert javascript atau parameter
                echo "<script>
                        alert('Username atau Password Salah!');
                        window.location.href = '" . BASEURL . "/auth';
                      </script>";
                exit;
            }
        } else {
            // Jika akses langsung ke method login tanpa POST
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function logout() {
        // Bersihkan semua data session
        $_SESSION = [];
        session_unset();
        session_destroy();

        // Redirect ke halaman login setelah logout
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}