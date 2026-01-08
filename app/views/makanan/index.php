<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-0">Menu <span class="text-danger">KulinerKu</span></h2>
            <p class="text-muted">Daftar menu lezat siap saji untuk Anda</p>
        </div>
        <div class="col-lg-6">
            <form action="<?= BASEURL; ?>/makanan" method="post" class="d-flex gap-2">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control rounded-pill-start border-0 shadow-sm px-4" 
                           placeholder="Cari menu..." value="<?= isset($_SESSION['keyword_makanan']) ? $_SESSION['keyword_makanan'] : ''; ?>">
                    <button class="btn btn-danger rounded-pill-end px-4 shadow-sm" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
                <?php if(isset($_SESSION['keyword_makanan'])) : ?>
                    <a href="<?= BASEURL; ?>/makanan/reset" class="btn btn-outline-secondary rounded-pill">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="row">
        <?php if($data['menu']->num_rows > 0) : ?>
            <?php while($row = $data['menu']->fetch_assoc()) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-light text-danger rounded-pill px-3 py-2"><?= $row['kategori']; ?></span>
                            <small class="text-muted">Stok: <?= $row['stok']; ?></small>
                        </div>
                        
                        <h4 class="fw-bold mb-2"><?= $row['nama_menu']; ?></h4>
                        <h5 class="text-danger fw-bold mb-4">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></h5>
                        
                        <div class="mt-auto">
                            <a href="<?= BASEURL; ?>/checkout/tambah/<?= $row['id']; ?>" class="btn btn-danger w-100 rounded-pill py-2 fw-bold">
                                <i class="bi bi-cart-plus me-2"></i>Tambah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12 text-center py-5">
                <h4 class="fw-bold">Menu tidak ditemukan...</h4>
                <p class="text-muted">Coba cari dengan kata kunci lain.</p>
                <a href="<?= BASEURL; ?>/makanan/reset" class="btn btn-danger rounded-pill px-4">Lihat Semua Menu</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if($data['jumlahHalaman'] > 1) : ?>
    <nav aria-label="Page navigation" class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($data['halamanAktif'] <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link rounded-pill-start shadow-sm" href="<?= BASEURL; ?>/makanan?halaman=<?= $data['halamanAktif'] - 1; ?>">Prev</a>
            </li>

            <?php for($i = 1; $i <= $data['jumlahHalaman']; $i++) : ?>
                <li class="page-item <?= ($i == $data['halamanAktif']) ? 'active' : ''; ?>">
                    <a class="page-link shadow-sm" href="<?= BASEURL; ?>/makanan?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($data['halamanAktif'] >= $data['jumlahHalaman']) ? 'disabled' : ''; ?>">
                <a class="page-link rounded-pill-end shadow-sm" href="<?= BASEURL; ?>/makanan?halaman=<?= $data['halamanAktif'] + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<style>
    .card-hover {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        border-color: #dc3545 !important;
    }
    .page-link {
        color: #dc3545;
        border: none;
        margin: 0 3px;
        font-weight: 600;
        padding: 10px 18px;
    }
    .page-item.active .page-link {
        background-color: #dc3545;
        color: white;
    }
    .form-control:focus {
        box-shadow: none;
        border: 1px solid #dc3545;
    }
</style>