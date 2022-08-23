<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Ubah Password Pengguna</h1>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Ubah Password</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <form class="form-horizontal r-separator border-top" method="POST">
                    <div class="card-body">
                        <div class="form-group row align-items-center mb-0">
                            <label for="password" class="col-3 text-end control-label col-form-label ">Password</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control" id="password" name="password" placeholder="password" value="<?= old('password') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="password_confirm" class="col-3 text-end control-label col-form-label ">Konfirmasi Password</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control" id="password_confirm" name="password_confirm" placeholder="Ulangi Password" value="<?= old('password_confirmation') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn badge btn-primary rounded-pill px-4 waves-effect waves-light" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn badge btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-user') ?>">
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