<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <h3 class="fw-bold mb-4">Item <span class="text-danger">Pilihanmu</span></h3>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Menu</th>
                            <th class="py-3">Harga</th>
                            <th class="text-end pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0; 
                        // Ambil data keranjang dari database
                        while($item = $data['keranjang']->fetch_assoc()) : 
                            $total += $item['harga'];
                        ?>
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold d-block"><?= $item['nama_menu']; ?></span>
                            </td>
                            <td class="text-danger fw-bold">Rp <?= number_format($item['harga']); ?></td>
                            <td class="text-end pe-4">
                                <a href="<?= BASEURL; ?>/checkout/hapus/<?= $item['id_keranjang']; ?>" 
                                   class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                   onclick="return confirm('Hapus menu ini dari keranjang?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>

                        <?php if($total == 0) : ?>
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <p class="text-muted">Keranjang masih kosong nih.</p>
                                <a href="<?= BASEURL; ?>/makanan" class="btn btn-danger btn-sm rounded-pill">Pesan Sekarang</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 position-sticky" style="top: 20px;">
                <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>
                <hr>
                
                <form action="<?= BASEURL; ?>/checkout/bayar" method="post">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Total Tagihan</span>
                        <span class="h4 fw-bold text-danger">Rp <?= number_format($total); ?></span>
                    </div>

                    <input type="hidden" name="total_bayar" value="<?= $total; ?>">

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Pilih Pembayaran</label>
                        <select class="form-select rounded-3" name="metode" id="pilihMetode" required>
                            <option value="Tunai">Tunai (Bayar di Kasir)</option>
                            <option value="QRIS">QRIS / E-Wallet</option>
                        </select>
                    </div>

                    <div id="tampilanQRIS" class="text-center d-none border rounded-4 p-3 mb-3 bg-light">
                        <p class="small fw-bold text-primary mb-2">SILAKAN SCAN QRIS</p>
                        <img src="<?= BASEURL; ?>/img/qris.png" alt="QRIS" class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                        <p class="small text-muted mt-2 mb-0">A/N: KULINERKU RESTO</p>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-3 fw-bold mt-2" 
                            <?= ($total == 0) ? 'disabled' : ''; ?>>
                        BAYAR SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const selectMetode = document.getElementById('pilihMetode');
    const boxQRIS = document.getElementById('tampilanQRIS');

    selectMetode.addEventListener('change', function() {
        if (this.value === 'QRIS') {
            boxQRIS.classList.remove('d-none');
        } else {
            boxQRIS.classList.add('d-none');
        }
    });
</script>