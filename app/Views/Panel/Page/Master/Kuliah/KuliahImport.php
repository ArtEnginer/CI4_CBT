<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen matkul</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List matkul</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="<?= route_to('data-matkul-add') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
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
                                                    <a href="<?= route_to('data-kuliah-download') ?>" class="btn badge bg-primary btn-sm">Download Template</a>
                                                </li>
                                                <li class="list-group-item">Menggunakan NIM Mahasiswa yang ada pada sistem
                                                    <a href="<?= route_to('data-mahasiswa') ?>" class="btn badge bg-primary btn-sm">Lihat Data NIM</a>
                                                </li>
                                                <li class="list-group-item">Menggunakan Kode Mata Kuliah yang sudah di tentukan oleh sistem
                                                    <a href="<?= route_to('data-matkul') ?>" class="btn badge bg-primary btn-sm">Lihat Data Kode</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <!-- bold warning -->
                                                    <b class="text-danger">Jika data tidak sesuai pada sistem maka data kuliah tidak bisa diimport secara benar</b> <br>
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
                            Input Data Kuliah
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-4">
                            <div class="col">
                                <form action="<?= route_to('data-kuliah-upload') ?>" class="dropzone" id="my-great-dropzone">
                                </form>
                            </div>
                        </div>
                        <div class="row text-center mb-4">
                            <div class="col">
                                <form action="<?= route_to('data-kuliah-save-excel') ?>" method="post">
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