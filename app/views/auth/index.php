<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    body, html {
        height: 100%;
        margin: 0;
    }

    /* Background dengan gambar makanan yang estetik */
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                    url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        
        /* Ini kunci agar konten berada tepat di tengah layar */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 15px;
    }

    .card-login {
        border: none;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(10px); /* Efek blur pada background */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        padding: 40px 30px;
        transition: transform 0.3s ease;
    }

    .card-login:hover {
        transform: translateY(-5px);
    }

    .brand-title {
        color: #d63031;
        font-weight: 700;
        font-size: 2.5rem;
        letter-spacing: -1px;
        margin-bottom: 5px;
    }

    .brand-subtitle {
        color: #636e72;
        font-size: 0.9rem;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #2d3436;
        margin-left: 5px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #dfe6e9;
        background-color: #f8f9fa;
        transition: all 0.3s;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #d63031;
        box-shadow: 0 0 0 0.25 red radial-gradient(circle, rgba(214,48,49,0.1) 0%, rgba(255,255,255,0) 70%);
    }

    .btn-login {
        background: linear-gradient(45deg, #d63031, #ff7675);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        color: white;
        margin-top: 15px;
        box-shadow: 0 10px 20px rgba(214, 48, 49, 0.3);
        transition: all 0.3s;
    }

    .btn-login:hover {
        background: linear-gradient(45deg, #b32525, #d63031);
        box-shadow: 0 5px 10px rgba(214, 48, 49, 0.2);
        transform: scale(1.02);
    }

    .footer-text {
        margin-top: 25px;
        font-size: 0.85rem;
        color: #636e72;
    }

    .footer-text a {
        color: #d63031;
        text-decoration: none;
        font-weight: 700;
    }

    /* Animasi masuk */
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="login-container fade-in">
    <div class="card card-login text-center">
        <h1 class="brand-title">KULINER<span style="color: #2d3436;">KU</span></h1>
        <p class="brand-subtitle">Cita Rasa Restoran di Ujung Jari Anda</p>

        <form action="<?= BASEURL; ?>/auth/login" method="POST">
            <div class="text-start mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." required autocomplete="off">
            </div>

            <div class="text-start mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login w-100">Login Sekarang</button>
        </form>

        <div class="footer-text">
            Belum punya akun? <a href="<?= BASEURL; ?>/auth/register">Daftar Akun Baru</a>
        </div>
    </div>
</div>