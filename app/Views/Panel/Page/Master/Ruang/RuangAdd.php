<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Data Ruangan</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Ruangan</li>
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
                            <label for="nama" class="col-3 text-end control-label col-form-label ">Nama</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control text-uppercase" id="nama" name="nama" placeholder="Nama Ruangan" value="<?= old('nama') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="tampung" class="col-3 text-end control-label col-form-label ">tampung</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="number" class="form-control" id="tampung" name="tampung" placeholder="tampung Ruangan" value="<?= old('tampung') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-ruang') ?>">
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