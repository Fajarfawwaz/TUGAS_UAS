<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-5 text-center bg-white" id="areaStruk">
                
                <div class="mb-4 text-success no-print">
                    <svg width="80" height="80" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>

                <h2 class="fw-bold mb-0">KULINERKU</h2>
                <p class="text-muted small mb-4">Jl. Raya Restoran No. 123, Indonesia</p>
                
                <div class="border-top border-bottom py-3 mb-4">
                    <h5 class="fw-bold mb-1">PESANAN BERHASIL!</h5>
                    <p class="text-muted mb-0 small">Nomor Nota: <span class="fw-bold text-dark">#<?= $data['id_nota']; ?></span></p>
                </div>

                <div class="text-start mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Pelanggan:</span>
                        <span class="small fw-bold"><?= $_SESSION['nama_user'] ?? 'Pelanggan'; ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Waktu:</span>
                        <span class="small"><?= date('d M Y, H:i'); ?> WIB</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Status:</span>
                        <span class="badge bg-success small">SUDAH DIBAYAR / DIPROSES</span>
                    </div>
                </div>

                <div class="alert alert-light border-0 small text-muted mb-4 py-3 rounded-4">
                    <i class="bi bi-info-circle me-1"></i>
                    Pesanan Anda telah masuk ke sistem dapur. Silakan tunggu nomor nota Anda dipanggil.
                </div>

                <div class="mt-2 no-print">
                    <div class="d-grid gap-2">
                        <button onclick="window.print()" class="btn btn-danger rounded-pill py-2 fw-bold">
                            <i class="bi bi-printer me-2"></i>Cetak Struk
                        </button>
                        <a href="<?= BASEURL; ?>/makanan" class="btn btn-link text-decoration-none text-muted small">Kembali ke Menu Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    /* Sembunyikan Header, Footer, dan Tombol saat print */
    .no-print, nav, footer, .btn, .alert {
        display: none !important;
    }
    
    body {
        background-color: white !important;
    }

    .container {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .card {
        box-shadow: none !important;
        border: none !important;
        width: 100% !important;
    }
}
</style>