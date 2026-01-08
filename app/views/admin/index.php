<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Panel <span class="text-danger">Administrator</span></h2>
        <button class="btn btn-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Menu Baru</button>
    </div>

    <ul class="nav nav-pills mb-4" id="pills-tab">
        <li class="nav-item"><button class="nav-link active me-2 rounded-pill" data-bs-toggle="pill" data-bs-target="#tab-produk">Kelola Menu</button></li>
        <li class="nav-item"><button class="nav-link rounded-pill" data-bs-toggle="pill" data-bs-target="#tab-sales">Riwayat Transaksi</button></li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="tab-produk">
            <div class="card border-0 shadow-sm p-3 rounded-4">
                <table class="table align-middle">
                    <thead><tr><th>Produk</th><th>Harga</th><th>Stok</th><th class="text-center">Aksi</th></tr></thead>
                    <tbody>
                        <?php while($m = $data['menu']->fetch_assoc()) : ?>
                        <tr>
                            <td class="fw-bold"><?= $m['nama_menu']; ?></td>
                            <td class="text-danger fw-bold">Rp <?= number_format($m['harga']); ?></td>
                            <td><?= $m['stok']; ?></td>
                            <td class="text-center">
                                <a href="<?= BASEURL; ?>/admin/hapus/<?= $m['id']; ?>" class="btn btn-sm btn-outline-danger px-3 rounded-pill" onclick="return confirm('Hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-sales">
            <div class="card border-0 shadow-sm p-3 rounded-4">
                <table class="table">
                    <thead class="bg-light"><tr><th>Nota</th><th>Pembeli</th><th>Total Bayar</th><th>Tanggal</th></tr></thead>
                    <tbody>
                        <?php if($data['riwayat'] && $data['riwayat']->num_rows > 0) : ?>
                            <?php while($r = $data['riwayat']->fetch_assoc()) : ?>
                            <tr>
                                <td class="fw-bold">#<?= $r['id']; ?></td>
                                <td><?= $r['nama_pembeli']; ?></td>
                                <td class="text-success fw-bold">Rp <?= number_format($r['total_harga']); ?></td>
                                <td><?= $r['tanggal_pesan']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada data transaksi di tabel 'pesanan'.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-5">
      <form action="<?= BASEURL; ?>/admin/tambah" method="post">
        <div class="modal-header border-0 px-4 pt-4"><h5 class="fw-bold">Input Menu Baru</h5></div>
        <div class="modal-body px-4">
          <div class="mb-3"><label class="small fw-bold">Nama Menu</label><input type="text" name="nama_menu" class="form-control" required></div>
          <div class="mb-3"><label class="small fw-bold">Kategori</label><input type="text" name="kategori" class="form-control" placeholder="Makanan/Minuman" required></div>
          <div class="row">
              <div class="col-6 mb-3"><label class="small fw-bold">Harga</label><input type="number" name="harga" class="form-control" required></div>
              <div class="col-6 mb-3"><label class="small fw-bold">Stok</label><input type="number" name="stok" class="form-control" required></div>
          </div>
        </div>
        <div class="modal-footer border-0 px-4 pb-4"><button type="submit" class="btn btn-danger w-100 rounded-pill py-2">SIMPAN</button></div>
      </form>
    </div>
  </div>
</div>