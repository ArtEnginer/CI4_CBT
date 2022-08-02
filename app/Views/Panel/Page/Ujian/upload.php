<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Ujian</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Buat Soal</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Download Template Soal
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form class="form-horizontal r-separator border-top" method="POST"
                                    action="<?= route_to('soal-download') ?>">
                                    <div class=" form-group row align-items-center mb-0">
                                        <label for="jumlah" class="col-3 text-end control-label col-form-label">Jumlah
                                            Soal</label>
                                        <div class="col-9 border-start pb-2 pt-2">
                                            <div class="input-group">
                                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                                    placeholder="Jumlah Soal" required>
                                                <span class="input-group-text">Butir</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="tipe" class="col-3 text-end control-label col-form-label">Banyak
                                            Pilihan</label>
                                        <div class="col-9 border-start pb-2 pt-2">
                                            <select class="form-select" aria-label="tipe" name="tipe" id="tipe"
                                                required>
                                                <option value="">Pilih Banyak Pilihan Ganda</option>
                                                <option value="pilgan1">4 Pilihan (a-d)</option>
                                                <option value="pilgan2">5 Pilihan (a-e)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary">Download</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                Upload Soal
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row text-center mb-4">
                                    <div class="col">
                                        <form action="<?= route_to('soal-upload') ?>" class="dropzone"
                                            id="my-great-dropzone">
                                        </form>
                                    </div>
                                </div>
                                <div class="row text-center mb-4">
                                    <div class="col">
                                        <form action="<?= route_to('soal-save') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $id_ujian ?>">
                                            <button type="submit" class="btn btn-primary">Unggah Soal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="<?= route_to('ujian-atur') ?>" role="button" class="btn app-btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>