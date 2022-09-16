<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Dosen</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List Dosen</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="<?= route_to('data-dosen-add') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="border-bottom text-center">
                                    <p class="text-center">
                                        Sebelum melakukan import data <b class="text-danger">Perhatikan </b>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col">

                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Menggunakan Template Excel Sistem
                                                    <a href="<?= route_to('data-dosen-download') ?>" class="btn badge bg-primary btn-sm">Download Template</a>
                                                </li>
                                            </ol>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom text-center">
                        <h4 class="card-title mb-0">
                            Input Data Dosen
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-4">
                            <div class="col">
                                <form action="<?= route_to('data-dosen-upload') ?>" class="dropzone" id="my-great-dropzone">
                                </form>
                            </div>
                        </div>
                        <div class="row text-center mb-4">
                            <div class="col">
                                <form action="<?= route_to('data-dosen-save-excel') ?>" method="post">
                                    <button type="submit" class="btn badge bg-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>