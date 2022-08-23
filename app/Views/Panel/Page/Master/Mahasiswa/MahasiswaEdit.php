<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Mahasiswa</h1>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Edit Data <?= $item->nama ?></h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <form class="form-horizontal r-separator" method="POST">
                    <div class="card-body">
                        <div class="form-group row align-items-center mb-0">
                            <label for="nama" class="col-3 text-end control-label col-form-label">Nama</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa" value="<?= $item->nama ?>" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="nim" class="col-3 text-end control-label col-form-label">NIM</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="number" name="nim" id="nim" class="form-control" placeholder="Nomor Induk Siswa" value="<?= $item->nim ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="alamat" class="col-3 text-end control-label col-form-label">Alamat</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Mahasiswa" required><?= $item->alamat ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="tahun_masuk" class="col-3 text-end control-label col-form-label">Tahun
                                Masuk</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-control" id="tahun_masuk" name="tahun_masuk" required>
                                    <?php
                                    for ($i = date('Y'); $i > date('Y') - 7; $i--) :
                                    ?>
                                        <option value="<?= $i ?>" <?= $item->tahun_masuk == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </div>
                            <!-- <input type="number" name="tahun_masuk" id="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="<?= $item->tahun_masuk ?>" required> -->
                        </div>
                    </div>

            </div>
            <div class="p-3 border-top">
                <div class="form-group mb-0 text-end">
                    <button type="submit" class="btn badge btn-primary rounded-pill px-4 waves-effect waves-light" name="add">
                        Simpan
                    </button>
                    <a role="button" class="btn badge btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-mahasiswa') ?>">
                        Kembali
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?= $this->endSection() ?>