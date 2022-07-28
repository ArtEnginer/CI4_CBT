<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Data Mahasiswa</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Mahasiswa</li>
                </ol>

            </div>
        </div>
    </div>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form class="form-horizontal r-separator border-top" method="POST">
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
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Mahasiswa" required><?= $item->alamat?></textarea>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="tahun_masuk" class="col-3 text-end control-label col-form-label">Tahun Masuk</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="number" name="tahun_masuk" id="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="<?= $item->tahun_masuk ?>" required>
                            </div>
                        </div>

                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-siswa') ?>">
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