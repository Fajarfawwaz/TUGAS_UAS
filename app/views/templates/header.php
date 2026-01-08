<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> | KULINERKU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #dc3545;
            --secondary-color: #ffc107;
            --dark-color: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff !important;
            padding: 12px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.6rem;
            letter-spacing: 1px;
        }

        .nav-link {
            color: #555 !important;
            font-weight: 500;
            margin: 0 8px;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* Indicator Garis Bawah untuk Link Aktif */
        .nav-link.active::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 3px;
            background: var(--primary-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }

        /* Cart Icon Styling */
        .cart-wrapper {
            position: relative;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s;
            border: 1px solid #eee;
        }

        .cart-wrapper:hover {
            background: #fff5f5;
            border-color: #ffc1c1;
        }

        .cart-badge {
            font-size: 0.7rem;
            font-weight: 700;
        }

        .btn-custom {
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 600;
            transition: 0.3s;
        }

        .shadow-soft {
            box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
        }

        /* Dropdown Styling */
        .dropdown-menu {
            border: none;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 8px 15px;
            font-weight: 500;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background-color: #fff5f5;
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-soft">
  <div class="container">
    <a class="navbar-brand fw-bold text-danger" href="<?= BASEURL; ?>">
        <i class="bi bi-egg-fried"></i> KULINERKU
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link px-3 <?= ($data['judul'] == 'Beranda') ? 'active' : ''; ?>" href="<?= BASEURL; ?>">Beranda</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link px-3 <?= (strpos($data['judul'], 'Menu') !== false) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/makanan">Daftar Menu</a>
        </li>
        
        <?php if(isset($_SESSION['login'])) : ?>
        <li class="nav-item">
            <a class="nav-link ms-lg-2" href="<?= BASEURL; ?>/checkout">
                <div class="cart-wrapper">
                    <i class="bi bi-bag-heart-fill fs-5 text-danger"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                        !
                    </span>
                </div>
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item ms-lg-4 mt-3 mt-lg-0">
            <?php if(!isset($_SESSION['login'])) : ?>
                <a class="btn btn-danger btn-custom shadow-sm w-100" href="<?= BASEURL; ?>/auth">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Akun
                </a>
            <?php else : ?>
                <div class="dropdown w-100">
                    <button class="btn btn-outline-danger btn-custom dropdown-toggle w-100 shadow-sm" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> <?= $_SESSION['nama'] ?? 'Akun Saya'; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end mt-3 border-0 shadow">
                        <li><h6 class="dropdown-header">Halo, Pelanggan!</h6></li>
                        
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                            <li><a class="dropdown-item fw-bold text-primary" href="<?= BASEURL; ?>/admin">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                            </a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>/admin">
                                <i class="bi bi-receipt me-2"></i> Riwayat Transaksi
                            </a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>/checkout">
                                <i class="bi bi-cart-check me-2"></i> Keranjang Saya
                            </a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>/checkout/riwayat">
                                <i class="bi bi-receipt me-2"></i> Riwayat Pesanan
                            </a></li>
                        <?php endif; ?>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="<?= BASEURL; ?>/auth/logout" onclick="return confirm('Yakin ingin logout?')">
                            <i class="bi bi-power me-2"></i> Keluar
                        </a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="py-4 flex-grow-1">